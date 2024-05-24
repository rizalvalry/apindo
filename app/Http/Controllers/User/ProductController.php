<?php

namespace App\Http\Controllers\User;

use App\Events\ChatEvent;
use App\Http\Controllers\Controller;
use App\Http\Traits\Notify;
use App\Http\Traits\Upload;
use App\Models\ProductQuery;
use App\Models\ProductReply;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    use Upload, Notify;

    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            return $next($request);
        });
        $this->theme = template();
    }

    public function productQuery(Request $request, $type = null)
    {
        $types = ['customer-enquiry', 'my-enquiry'];
        abort_if(!in_array($type, $types), 404);

        $search = $request->all();
        $fromDate = Carbon::parse($request->from_date);
        $toDate = Carbon::parse($request->to_date)->addDay();

        $data['customerEnquery'] = ProductQuery::where('user_id', $this->user->id)->where('customer_enquiry', 0)->get();

        $data['customerReply'] = ProductQuery::has('unseenReplies')
            ->where('user_id', $this->user->id)
            ->count();

        $data['myReply'] = ProductQuery::has('unseenReplies')
            ->where('client_id', $this->user->id)
            ->count();

        $data['type'] = $type;
        $data['productQueries'] = ProductQuery::with(['get_user', 'get_client', 'get_listing', 'get_product'])
            ->when(isset($search['name']), function ($query) use ($search) {
                return $query->whereHas('get_listing', function ($q) use ($search) {
                    $q->where('title', $search['name']);
                })->orWhereHas('get_product', function ($q2) use ($search) {
                    $q2->where('product_title', 'LIKE', "%{$search['name']}%");
                });
            })
            ->when(isset($search['from_date']), function ($q2) use ($fromDate) {
                return $q2->whereDate('created_at', '>=', $fromDate);
            })
            ->when(isset($search['to_date']), function ($q2) use ($fromDate,$toDate) {
                return $q2->whereBetween('created_at', [$fromDate,$toDate]);
            })
            ->when($type == 'customer-enquiry', function ($query) {
                return $query->where('user_id', $this->user->id)->where('client_id', '!=', $this->user->id);
            })
            ->when($type == 'my-enquiry', function ($query) {
                return $query->where('client_id', $this->user->id)->where('user_id', '!=', $this->user->id);
            })
            ->latest()
            ->paginate(config('basic.paginate'));
        return view($this->theme . 'user.productQuery', $data);
    }

    public function sendProductQuery()
    {
        $data['sendProductQueries'] = ProductQuery::where('client_id', $this->user->id)->latest()->paginate(config('basic.paginate'));
        return view($this->theme . 'user.sendProductQuery');
    }

    public function productQueryDelete($id)
    {
        ProductQuery::where('user_id', $this->user->id)->findOrFail($id)->delete();
        return back()->with('success', __('Delete Successfull!'));
    }

    public function productQueryReply($id)
    {
        $all_unseen_messages = ProductReply::where('product_query_id', $id)->where('client_id', $this->user->id)->where('status', 0)->get();
        foreach ($all_unseen_messages as $message) {
            ProductReply::findOrFail($message->id)->update([
                'status' => 1,
            ]);
        }

        $data['singleProductQuery'] = ProductQuery::with(['get_user', 'get_client', 'get_product', 'get_listing.get_user'])->findOrFail($id);

        if (Auth::user()->id == $data['singleProductQuery']->user_id) {
            ProductQuery::findOrFail($id)->update([
                'customer_enquiry' => 1,
            ]);
        }
        return view($this->theme . 'user.productQueryReply', $data, compact('id'));
    }

    public function productReplyMessage(Request $request)
    {
        $this->validate($request, [
            'file' => 'nullable|mimes:jpg,png,jpeg,PNG|max:3072',
        ]);

        $productReply = new ProductReply();
        $productReply->user_id = $this->user->id;
        $productReply->client_id = $request->client_id;
        $productReply->product_query_id = $request->product_query_id;
        $productReply->reply = $request->reply;

        if($request->hasFile('file')){
            $image = $this->fileUpload($request->file, config('location.message.path'), $productReply->driver, null);
            if ($image) {
                $productReply->file = $image['path'];
                $productReply->driver = $image['driver'];
            }
            $fileImage = getFile($productReply->driver, $image['path']);
        } else{
            $fileImage = null;
        }

        $productReply->save();

        $sender_image = getFile($this->user->driver, $this->user->image);

        $response = [
            'user_id' => $productReply->user_id,
            'client_id' => $productReply->client_id,
            'product_query_id' => $productReply->product_query_id,
            'reply' => $productReply->reply,
            'fileImage' => $fileImage,
            'sender_image' => $sender_image,
        ];

        ChatEvent::dispatch((object) $response);

        return response()->json($response);
    }

    public function productReplyMessageRender(Request $request)
    {
        $messages = ProductReply::with('get_user:id,firstname,lastname,username,image,driver', 'get_client:id,firstname,lastname,username,image,driver')
            ->where('product_query_id', $request->productId)->orderBy('id', 'ASC')
                        ->get()
                        ->map(function ($item) {
                            $image = getFile($item->get_user->driver, $item->get_user->image);
                            $item['sender_image'] = $image;
                            return $item;
                        })
                        ->map(function ($item) {
                            $image = getFile($item->get_client->driver, $item->get_client->image);
                            $item['receiver_image'] = $image;
                            return $item;
                        })
                        ->map(function ($item) {
                            if (isset($item->file)){
                                $file = getFile($item->driver, $item->file);
                                $item['fileImage'] = $file;
                            }
                            return $item;
                        });
        $messages->push(auth()->user());

        return response()->json($messages);
    }
}
