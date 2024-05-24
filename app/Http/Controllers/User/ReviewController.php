<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use App\Models\UserReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\Notify;
use App\Http\Traits\Upload;
use Stevebauman\Purify\Facades\Purify;

class ReviewController extends Controller
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

    public function sendReview(Request $request){

        $purifiedData = Purify::clean($request->except('image', '_token', '_method'));
        $rules = [
            'review' => 'required',
        ];
        $message = [
            'review.required' => __('Review is required'),
        ];

        $validate = Validator::make($purifiedData, $rules, $message);

        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }

        $listing = Listing::with('get_user')->where('user_id', $this->user->id)->findOrFail($request->listing_id);
        $reviewExist = UserReview::where('listing_id', $request->listing_id)->where('user_id', $this->user->id)->first();
        if ($reviewExist){
            return back()->with('error', __("You have already given a review to this listing"));
        }else{
            if ($listing->user_id == $this->user->id){
                return back()->with('error', __("You can't review your listing"));
            }else{
                $user_review = new UserReview();
                $user_review->listing_id = $request->listing_id;
                $user_review->user_id = Auth::user()->id;
                $user_review->rating2 = $request->rating2;
                $user_review->review = $request->review;
                $user_review->save();

                $user = $listing->get_user;
                $reviewerName = Auth::user()->firstname . ' ' . Auth::user()->lastname;
                $msg = [
                    'listingTitle' => $listing->title??null,
                    'from' => $reviewerName??null,
                ];

                $action = [
                    "link" => route('listing-details', [slug($listing->title),$request->listing_id]),
                    "icon" => "fa fa-money-bill-alt text-white"
                ];

                $this->userPushNotification($user, 'REVIEW_MESSAGE', $msg, $action);
                $this->adminPushNotification('REVIEW_MESSAGE', $msg, $action);

                return redirect()->route('listing-details', [@slug($listing->title), $request->listing_id])->with('success', __('Review Sent Successfully!'));
            }
        }
    }
}
