<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Models\Place;
use App\Models\PlaceDetails;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;

class PlaceController extends Controller
{
    public function place(){
        $data['places'] = Place::with('details')->latest()->get();
        return view('admin.place.index', $data);
    }

    public function placeCreate(){
        return view('admin.place.create');
    }

    public function placeStore(Request $request){
        $purifiedData = Purify::clean($request->except('image', '_token', '_method'));

        $rules = [
            'place' => 'required|max:191',
            'lat'   => 'required',
            'long'  => 'required',
        ];

        $message = [
            'place.required' => __('Please write/select a place'),
            'lat.required' => __('Latitude field is required'),
            'long.required' => __('Longitude field is required'),
        ];

        $validate = Validator::make($purifiedData, $rules, $message);

        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }

        $place = new Place();
        $place->lat = $request->lat;
        $place->long = $request->long;
        $place->status = $request->status;
        $place->save();

        $place->details()->create([
            'place' => $request->place,
        ]);
        return back()->with('success', __('Place Successfully Saved'));
    }

    public function placeEdit($id)
    {
        $data['placeDetails'] = PlaceDetails::with('places')->where('place_id', $id)->first();

        return view('admin.place.edit', $data, compact('id'));
    }

    public function placeUpdate(Request $request, $id){
        $purifiedData = Purify::clean($request->except('image', '_token', '_method'));

        $rules = [
            'place' => 'required|max:191',
            'lat'   => 'required',
            'long'  => 'required',
        ];

        $message = [
            'place.required' => __('Please write/select a place'),
            'lat.required'   => __('Latitude field is required'),
            'long.required'  => __('Longitude field is required'),
        ];

        $validate = Validator::make($purifiedData, $rules, $message);

        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }

        $place = Place::findOrFail($id);
        $place->lat = $request->lat;
        $place->long = $request->long;
        $place->status = $request->status;
        $place->save();

        $place->details()->update([
                'place' => $request->place,
            ]
        );
        return back()->with('success', __('Place Successfully Updated'));
    }

    public function placeDelete($id){
        $place = Place::findOrFail($id);
        $place->delete();
        return back()->with('success', __('Place has been deleted'));
    }
}
