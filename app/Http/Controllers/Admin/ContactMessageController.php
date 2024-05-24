<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactMessage;
use App\Http\Traits\Notify;
use App\Http\Traits\Upload;
use Carbon\Carbon;

class ContactMessageController extends Controller
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

    public function contactMessage(Request $request){
        $search = $request->all();
        $fromDate =   Carbon::parse($request->from_date);
        $toDate =   Carbon::parse($request->to_date)->addDay();

        $data['allMessages'] = ContactMessage::with(['get_client', 'get_user'])
            ->when(isset($search['from_date']), function ($query) use($fromDate, $toDate){
                return $query->whereDate('created_at', $fromDate)->orWhereBetween('created_at', [$fromDate, $toDate]);
            })
            ->when(isset($search['from_date']), function ($q1) use ($fromDate) {
                return $q1->whereDate('created_at', '>=', $fromDate);
            })
            ->when(isset($search['to_date']), function ($q2) use ($fromDate,$toDate) {
                return $q2->whereBetween('created_at', [$fromDate,$toDate]);
            })
            ->latest()->paginate(config('basic.paginate'));
        return view('admin.contact.contactMessage', $data);
    }

    public function contactMessageDelete($id){
        ContactMessage::findOrFail($id)->delete();
        return back()->with('success', __('Message Delete Successfully!'));
    }
}
