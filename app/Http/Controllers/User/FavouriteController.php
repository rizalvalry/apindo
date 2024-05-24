<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Favourite;
use App\Models\Listing;
use Illuminate\Http\Request;
use App\Http\Traits\Notify;
use App\Http\Traits\Upload;

class FavouriteController extends Controller
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

    public function wishList(Request $request)
    {
        $userId = $this->user->id;
        $listing = Listing::with('getFavourite')->find($request->listing_id);

        if ($listing->getFavourite) {
            $stage='remove';
            $favourite = Favourite::where('listing_id',$request->listing_id)->where('client_id', $this->user->id)->first();
            $favourite->delete();

        } else {
            $stage ='added';
            $data = new Favourite();
            $data->user_id = $request->user_id;
            $data->client_id = $this->user->id;
            $data->purchase_package_id = $request->purchase_package_id;
            $data->listing_id =$request->listing_id;
            $data->save();
        }
        return response()->json([
            'data' => $stage
        ]);
    }
}
