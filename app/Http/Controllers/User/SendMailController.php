<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ClaimBusiness;
use App\Models\ContactMessage;
use App\Models\Listing;
use App\Models\Product;
use App\Models\ProductQuery;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;
use App\Http\Traits\Notify;
use App\Http\Traits\Upload;

class SendMailController extends Controller
{
    use Notify, Upload;

    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            return $next($request);
        });
        $this->theme = template();
    }

    public function sendListingMessage(Request $request, $id)
    {
        $purifiedData = Purify::clean($request->except('_token', '_method'));
        $rules = [
            'name' => 'required|max:50',
            'message' => 'required',
        ];
        $message = [
            'name.required' => __('Please write your name'),
            'message.required' => __('Please Write your message'),
        ];

        $validate = Validator::make($purifiedData, $rules, $message);

        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }

        $listing = Listing::with('get_user')->findOrFail($id);
        $user = $listing->get_user;
        $senderName = Auth::user()->firstname . ' ' . Auth::user()->lastname;

        $contactMessage = new ContactMessage();
        $contactMessage->user_id = $user->id;
        $contactMessage->client_id = Auth::user()->id;
        $contactMessage->listing_id = $id;
        $contactMessage->message = $request->message;
        $contactMessage->save();

        $msg = [
            'listingTitle' => $listing->title ?? null,
            'from' => $senderName ?? null,
        ];

        $action = [
            "link" => '#',
            "icon" => "fa fa-money-bill-alt text-white"
        ];

        $action2 = [
            "link" => route('admin.contactMessage'),
            "icon" => "fa fa-money-bill-alt text-white"
        ];

        $this->userPushNotification($user, 'LISTING_MESSAGE', $msg, $action);
        $this->adminPushNotification('LISTING_MESSAGE', $msg, $action2);

        $details = [
            'sub' => '[' . config('basic.site_title') . ']' . ' Contact Message sent from ' . $senderName,
            'replyToEmail' => Auth::user()->email,
            'replyToName' => $senderName,
            'message' => $request->message,
        ];

        Mail::to($user->email)->send(new \App\Mail\UserContact($details));
        return back()->with('success', __('Message has been sent'));

    }

    public function claimBusiness(Request $request, $id)
    {
        $purifiedData = Purify::clean($request->except('_token', '_method'));
        $rules = [
            'name' => 'required|max:50',
            'message' => 'required',
        ];
        $message = [
            'name.required' => __('Please write your name'),
            'message.required' => __('Please Write your message'),
        ];

        $validate = Validator::make($purifiedData, $rules, $message);

        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }

        $listing = Listing::findOrFail($id);

        if ($listing->user_id == $this->user->id) {
            return back()->with('warning', __('You can not claim your business!'));
        } else {
            $claim = new ClaimBusiness();
            $claim->listing_id = $id;
            $claim->client_id = $this->user->id;
            $claim->message = $request->message;
            $claim->save();
            $senderName = $this->user->firstname . ' ' . $this->user->lastname;
            $msg = [
                'listing' => $listing->title ?? null,
                'from' => $senderName ?? null,
            ];

            $action = [
                "link" => route('admin.claimBusiness'),
                "icon" => "fa fa-money-bill-alt text-white"
            ];

            $this->adminPushNotification('LISTING_CLAIM', $msg, $action);


            return back()->with('success', __('Message sent successfully!'));
        }
    }

    public function viewerSendMessageToListingUser(Request $request, $id)
    {
        $purifiedData = Purify::clean($request->except('_token', '_method'));
        $rules = [
            'name' => 'required|max:50',
            'message' => 'required',
        ];
        $message = [
            'name.required' => __('Please write your name'),
            'message.required' => __('Please Write your message'),
        ];

        $validate = Validator::make($purifiedData, $rules, $message);

        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }

        $user = User::findOrFail($id);

        $senderName = Auth::user()->firstname . ' ' . Auth::user()->lastname;

        $contactMessage = new ContactMessage();
        $contactMessage->user_id = $id;
        $contactMessage->client_id = Auth::id();
        $contactMessage->message = $request->message;
        $contactMessage->save();

        $msg = [
            'from' => $senderName ?? null,
        ];

        $userAction = [
            "link" => route('profile', [@slug($user->firstname), $user->id]),
            "icon" => "fa fa-money-bill-alt text-white"
        ];

        $adminAction = [
            "link" => route('admin.contactMessage'),
            "icon" => "fa fa-money-bill-alt text-white"
        ];

        $this->userPushNotification($user, 'VIEWER_MESSAGE', $msg, $userAction);
        $this->adminPushNotification('VIEWER_MESSAGE', $msg, $adminAction);

        $details = [
            'sub' => '[' . config('basic.site_title') . ']' . ' Contact Message sent from ' . $senderName,
            'replyToEmail' => Auth::user()->email,
            'replyToName' => $senderName,
            'message' => $request->message,
        ];

        Mail::to($user->email)->send(new \App\Mail\UserContact($details));
        return back()->with('success', __('Message has been sent'));
    }


    public function sendProductQuery(Request $request)
    {

        $purifiedData = Purify::clean($request->except('_token', '_method'));
        $rules = [
            'message' => 'required',
        ];
        $message = [
            'message.required' => __('Please write your message'),
        ];

        $validate = Validator::make($purifiedData, $rules, $message);

        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }

        $listing = Listing::findOrFail($request->listing_id);
        if ($listing->user_id == $this->user->id) {
            return back()->with('error', __('You cannot make any queries on your product'));
        } else {
            $productQuery = new ProductQuery();
            $productQuery->user_id = $listing->user_id;
            $productQuery->client_id = $this->user->id;
            $productQuery->listing_id = $request->listing_id;
            $productQuery->product_id = $request->product_id;
            $productQuery->message = $request->message;
            $productQuery->save();

            $product = Product::findOrFail($request->product_id);

            $senderName = Auth::user()->firstname . ' ' . Auth::user()->lastname;
            $msg = [
                'productTitle' => $product->product_title,
                'from' => $senderName,
            ];

            $action = [
                "link" => route('user.productQuery'),
                "icon" => "fa fa-money-bill-alt text-white"
            ];

            $adminAction = [
                "link" => route('listing-details', [@slug($listing->title), $listing->id]),
                "icon" => "fa fa-money-bill-alt text-white"
            ];

            $user = User::findOrFail($listing->user_id);

            $this->userPushNotification($user, 'PRODUCT_QUERY', $msg, $action);
            $this->adminPushNotification('PRODUCT_QUERY', $msg, $adminAction);

            $this->sendMailSms($user, 'PRODUCT_QUERY', [
                'productTitle' => $product->product_title ?? null,
                'from' => $senderName,
            ]);

            return back()->with('success', __('Your query has been sent'));
        }

    }
}
