<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\ListingTrait;
use App\Models\Amenity;
use App\Models\Analytics;
use App\Models\BusinessHour;
use App\Models\Configure;
use App\Models\Favourite;
use App\Models\Listing;
use App\Models\ListingAminity;
use App\Models\ListingApproval;
use App\Models\ListingImage;
use App\Models\ListingSeo;
use App\Models\Package;
use App\Models\PackageExpiryCron;
use App\Models\Place;
use App\Models\Product;
use App\Models\ProductQuery;
use App\Models\PurchasePackage;
use App\Models\UserReview;
use App\Models\WebsiteAndSocial;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Traits\Upload;
use App\Http\Traits\Notify;
use App\Models\Language;
use App\Models\ListingCategory;
use App\Models\ListingCategoryDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;

class ListingController extends Controller
{
    use Upload, Notify, ListingTrait;

    public function listingCategoryList()
    {
        $data['listingCategory'] = ListingCategory::with('details')->latest()->get();
        return view('admin.listing.categoryList', $data);
    }

    public function listingCategoryCreate()
    {
        $languages = Language::all();
        return view('admin.listing.listingCategoryCreate', compact('languages'));
    }

    public function listingCategoryStore(Request $request, $language)
    {

        $purifiedData = Purify::clean($request->except('icon', '_token', '_method'));
        $purifiedData['icon'] = $request->icon ?? null;

        $rules = [
            'name.*' => 'required|max:100',
            'icon' => 'required|max:100',
        ];

        $message = [
            'name.*.required' => __('Category name field is required'),
            'icon.required' => __('Icon field is required'),
        ];

        $validate = Validator::make($purifiedData, $rules, $message);

        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }

        $listingCategory = new ListingCategory();
        $listingCategory->icon = $request->icon;
        $listingCategory->status = $request->status;
        $listingCategory->save();

        $listingCategory->details()->create([
            'language_id' => $language,
            'name' => $purifiedData["name"][$language],
        ]);
        return back()->with('success', __('Listing Category Successfully Saved'));
    }

    public function listingCategoryDelete($id)
    {
        $listingCategory = ListingCategory::findOrFail($id);
        $listingCategory->delete();
        return back()->with('success', __('Listing Category has been deleted'));
    }

    public function listingCategoryEdit($id)
    {
        $data['languages'] = Language::all();
        $data['listingCategoryDetails'] = ListingCategoryDetails::with('category')->where('listing_category_id', $id)->get()->groupBy('language_id');
        return view('admin.listing.listingCategoryEdit', $data, compact('id'));
    }

    public function listingCategoryUpdate(Request $request, $id, $language_id)
    {
        $purifiedData = Purify::clean($request->except('_token', '_method', 'icon'));
        $purifiedData['icon'] = $request->icon ?? null;

        $rules = [
            'name.*' => 'required|max:100',
            'icon' => 'sometimes|max:100',
        ];

        $message = [
            'name.*.required' => __('Category name field is required'),
            'icon.required' => __('Icon field is required'),
        ];

        $validate = Validator::make($purifiedData, $rules, $message);

        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }

        $listingCategory = ListingCategory::findOrFail($id);

        if ($request->has('icon')) {
            $listingCategory->icon = $request->icon;
        }
        if ($request->has('status')) {
            $listingCategory->status = $request->status;
        }
        $listingCategory->save();

        $listingCategory->details()->updateOrCreate([
            'language_id' => $language_id
        ],
            [
                'name' => $purifiedData["name"][$language_id],
            ]
        );
        return back()->with('success', __('Listing Category Successfully Updated'));
    }

    public function viewListings(Request $request, $type = null, $id = null)
    {
        $data['listingCategories'] = ListingCategory::with('details')->latest()->get();
        $data['allLocations'] = Place::with('details')->latest()->get();
        $data['packages'] = Package::with('details')->latest()->get();
        $search = $request->all();
        $categoryIds = $request->category;
        $fromDate = Carbon::parse($request->from_date);
        $toDate = Carbon::parse($request->to_date)->addDay();


        $data['all_user_listings'] = Listing::with(['get_user', 'get_package.get_package', 'get_place'])
            ->when(isset($categoryIds), function ($query) use ($categoryIds) {
                if (implode('',$categoryIds) == 'all'){
                    $query->where('status', 1)->where('is_active', 1);
                }else{
                    foreach ($categoryIds as $key => $category_id) {
                        $query->whereJsonContains('category_id', $category_id);
                    }
                }
            })
            ->when(isset($search['title']), function ($query) use ($search) {
                return $query->where('title', 'LIKE', "%{$search['title']}%");
            })
            ->when(isset($id), function ($query) use ($id) {
                return $query->where('id', $id);
            })
            ->when(isset($search['package']), function ($qq) use ($search) {
                return $qq->whereHas('get_package', function ($query) use ($search) {
                    $query->where('package_id', $search['package']);
                });
            })
            ->when(isset($search['location']), function ($q1) use ($search) {
                return $q1->whereHas('get_place', function ($query) use ($search) {
                    $query->where('id', $search['location']);
                });
            })
            ->when(isset($search['from_date']), function ($q2) use ($fromDate) {
                return $q2->whereDate('created_at', '>=', $fromDate);
            })
            ->when(isset($search['to_date']), function ($q2) use ($fromDate, $toDate) {
                return $q2->whereBetween('created_at', [$fromDate, $toDate]);
            })
            ->when(isset($search['status']), function ($q2) use ($search) {
                return $q2->where('status', $search['status']);
            })
            ->latest()->paginate(config('basic.paginate'));

        return view('admin.listing.viewListing', $data);
    }

    public function editListing($id)
    {
        $data['single_listing_infos'] = Listing::findOrFail($id);
        $data['single_package_infos'] = PurchasePackage::with('get_package')->findOrFail($data['single_listing_infos']->purchase_package_id);
        $data['all_listings_category'] = ListingCategory::with('details')->latest()->get();
        $data['all_places'] = Place::with('details')->latest()->get();
        $data['all_amenities'] = Amenity::with('details')->latest()->get();
        $data['listing_aminities'] = ListingAminity::select('amenity_id')->where('listing_id', $id)->get();
        $data['listing_seos'] = ListingSeo::where('listing_id', $id)->first();
        $data['listing_products'] = Product::with('get_product_image')->where('listing_id', $id)->get();
        $data['listing_seo'] = ListingSeo::where('listing_id', $id)->first();
        $data['business_hours'] = BusinessHour::where('listing_id', $id)->get();
        $data['social_links'] = WebsiteAndSocial::where('listing_id', $id)->get();
        $data['listing_images'] = ListingImage::where('listing_id', $id)->get()->map(function ($image){
            $image->src = getFile($image->driver, $image->listing_image);
            return $image;
        });
        return view('admin.listing.editListing', $data, compact('id'));
    }

    public function listingUpdate(Request $request, $id)
    {
        $purifiedData = Purify::clean($request->except('image', '_token', '_method', 'thumbnail', 'listing_image', 'seo_image', 'product_image'));
        $purifiedData['thumbnail'] = $request->thumbnail ?? null;
        $purifiedData['listing_image'] = $request->listing_image ?? null;
        $purifiedData['product_image'] = $request->product_image ?? null;
        $purifiedData['product_thumbnail'] = $request->product_thumbnail ?? null;

        $rules = [
            'title' => 'required|string|max:255',
            'category_id' => 'required|array',
            'category_id.*' => 'exists:listing_categories,id',
            'email' => 'nullable|email',
            'phone' => 'nullable|numeric',
            'description' => 'required|string',
            'place_id' => 'required|exists:places,id',
            'address' => 'required|string',
            'lat' => 'required|between:-90,90',
            'long' => 'required|between:-180,180',
            'working_day.*' => 'nullable|string|max:20',
            'social_url.*' => 'nullable|url|max:180',
            'youtube_video_id' => 'nullable|string|max:20',
            'thumbnail' => 'nullable|mimes:jpeg,png,jpg|max:51200',
            'listing_image.*' => 'nullable|mimes:jpeg,png,jpg',
            'amenity_id.*' => 'nullable|numeric|exists:amenities,id',
            'product_title.*' => 'nullable|string|max:150',
            'product_price.*' => 'nullable|numeric',
            'product_description.*' => 'nullable|string',
            'product_image.*.*' => 'nullable|mimes:jpeg,png,jpg',
            'product_thumbnail.*' => 'nullable|mimes:jpeg,png,jpg',
            'seo_image' => 'nullable|mimes:jpeg,png,jpg|max:51200',
            'meta_title' => 'nullable|string|max:200',
            'meta_keywords' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ];

        $message = [
            'thumbnail.mimes' => __('The thumbnail must be a file of type: jpg, jpeg, png.'),
            'thumbnail.max' => __('The thumbnail may not be greater than 5 MB.'),
            'category_id.required' => __('This category field is required.'),
            'category_id.array' => __('The category must be an array.'),
            'category_id.*.exists' => __('The selected category is invalid.'),
            'listing_image.*.mimes' => __('This listing image must be a file of type: jpg, jpeg, png.'),
            'working_day.*.string' => __('The working day must be a string.'),
            'working_day.*.max' => __('The working day may not be greater than :max characters.'),
            'social_url.*.url' => __('The social url should be a url.'),
            'social_url.*.max' => __('The social url may not be greater than :max characters.'),
            'product_title.*.string' => __('The product title must be a string.'),
            'product_title.*.max' => __('The product title may not be greater than :max characters.'),
            'product_price.*.numeric' => __('The product price should be numeric.'),
            'product_description.*.string' => __('The product description must be a string.'),
            'product_image.*.*.mimes' => __('This product image must be a file of type: jpg, jpeg, png.'),
            'product_thumbnail.*.mimes' => __('This product thumbnail must be a file of type: jpg, jpeg, png.'),
            'product_thumbnail.*.max' => __('The product thumbnail may not be greater than 5 MB.'),
            'seo_image' => __('The seo image may not be greater than 5 MB.'),
        ];

        $validate = Validator::make($purifiedData, $rules, $message);

        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }

        $listing = Listing::has('get_package')->with('get_package')->findOrFail($id);

        if ($request->hasFile('thumbnail')) {
            if (isset($listing->thumbnail)) {
                $this->fileDelete($listing->driver, $listing->thumbnail);
            }
            try {
                $image = $this->fileUpload($request->thumbnail, config('location.listing_thumbnail.path'), $listing->driver, null);
                if ($image) {
                    $listing->thumbnail = $image['path'];
                    $listing->driver = $image['driver'];
                }
            } catch (\Exception $exp) {
                return back()->with('error', __('Image could not be uploaded.'));
            }
        }

        $listing->title = $request->title;

        $numberOfCategoriesPerListing = min(count($request->category_id), optional($listing->get_package)->no_of_categories_per_listing ?? 1);
        $listing->category_id = array_slice($request->category_id, 0, $numberOfCategoriesPerListing);

        $listing->phone = $request->phone;
        $listing->email = $request->email;
        $listing->description = $request->description;
        $listing->place_id = $request->place_id;
        $listing->address = $request->address;
        $listing->lat = $request->lat;
        $listing->long = $request->long;


        if ($request->youtube_video_id) {
            $listing->youtube_video_id = $request->youtube_video_id;
        }

        if(optional($listing->get_package)->is_whatsapp == 1 || optional($listing->get_package)->is_messenger == 1){
            $listing->fb_app_id = $request->fb_app_id;
            $listing->fb_page_id = $request->fb_page_id;
            $listing->whatsapp_number = $request->whatsapp_number;
            $listing->replies_text = $request->replies_text;
            $listing->body_text = $request->body_text;
        }

        $listing->save();

        if (optional($listing->get_package)->is_business_hour && !empty($request->working_day)) {
            BusinessHour::where('listing_id', $id)->delete();
            $this->insertBusinessHours($request, $listing, $listing->purchase_package_id);
        }


        if ($request->social_icon) {
            WebsiteAndSocial::where('listing_id', $id)->delete();
            $this->insertSocialAndWebsite($request, $listing, $listing->purchase_package_id);
        }

        $old_listing_image = $request->old_listing_image ?? [];
        $dbImages = ListingImage::where('listing_id', $listing->id)->whereNotIn('id', $old_listing_image)->get();
        foreach ($dbImages as $dbImage) {
            $this->fileDelete($dbImage->driver, $dbImage->listing_image);
            $dbImage->delete();
        }

        if (optional($listing->get_package)->is_image && !empty($request->listing_image)) {
            $numberOfImagePerListing = optional($listing->get_package)->no_of_img_per_listing ?? 500;
            $leftNumberOfImagePerListing = min(count($request->listing_image), ($numberOfImagePerListing - count($old_listing_image ?? [])));
            $this->uploadListingImages($leftNumberOfImagePerListing, $request, $listing, $listing->purchase_package_id);
        }


        if (optional($listing->get_package)->is_amenities && !empty($request->amenity_id)) {
            ListingAminity::where('listing_id', $id)->delete();
            $numberOfAmenitiesPerListing = min(count($request->amenity_id), optional($listing->get_package)->no_of_amenities_per_listing ?? 500);
            $this->insertAmenitites($numberOfAmenitiesPerListing, $request, $listing, $listing->purchase_package_id);
        }

        $oldProductImages = $request->product_id ?? [];
        $dbProducts = Product::with('get_product_image')->where('listing_id', $listing->id)->whereNotIn('id', $oldProductImages)->get();
        foreach ($dbProducts as $dbProduct) {
            foreach ($dbProduct->get_product_image as $pImage) {
                $this->fileDelete($pImage->driver, $pImage->product_image);
                $pImage->delete();
            }
            $this->fileDelete($dbProduct->driver, $dbProduct->product_thumbnail);
            $dbProduct->delete();
        }

        if (optional($listing->get_package)->is_product && !empty($request->product_title)) {
            $numberOfProductsPerListing = min(count($request->product_title), optional($listing->get_package)->no_of_product ?? 500);
            $this->uploadProducts($request, $listing, $numberOfProductsPerListing, false);
        }


        if (optional($listing->get_package)->seo && ($request->meta_title || $request->meta_description || $request->meta_keywords || $request->seo_image)) {
            $this->insertSEO($listing, $request, $listing->purchase_package_id);
        }

        return back()->with('success', __('Listing update successfully'));
    }


    public function viewListingDelete($id)
    {
        $listing = Listing::with(['get_package', 'listingImages', 'get_listing_amenities', 'get_business_hour', 'get_social_info', 'get_products', 'listingSeo', 'get_reviews', 'listingAnalytics', 'listingClaims', 'allWishlists', 'productQueries.replies', 'listingViews'])->findOrFail($id);

        if (optional($listing->get_package)->expire_date != null) {
            $expiry_date = $listing->get_package->expire_date->format('Y-m-d');
            $current_date = Carbon::now()->format('Y-m-d');
            $no_of_listing = $listing->get_package->no_of_listing;

            if ($current_date <= $expiry_date) {
                $increase = $no_of_listing + 1;
                $listing->get_package->no_of_listing = $increase;
                $listing->get_package->save();
            }
        }

        foreach ($listing->listingImages as $lisImage) {
            $this->fileDelete($lisImage->driver, $lisImage->listing_image);
            $lisImage->delete();
        }

        $this->fileDelete($listing->driver, $listing->thumbnail);

        $allProducts = $listing->get_products;
        foreach ($allProducts as $dbProduct) {
            foreach ($dbProduct->get_product_image as $pImage) {
                $this->fileDelete($pImage->driver, $pImage->product_image);
                $pImage->delete();
            }
            $this->fileDelete($dbProduct->driver, $dbProduct->product_thumbnail);
            $dbProduct->delete();
        }

        $allProductQueries = $listing->productQueries;
        foreach ($allProductQueries as $query) {
            foreach ($query->replies as $reply) {
                $this->fileDelete($reply->driver, $reply->file);
                $reply->delete();
            }
            $query->delete();
        }

        if(optional($listing->listingSeo)->seo_image){
            $this->fileDelete(optional($listing->listingSeo)->driver, optional($listing->listingSeo)->seo_image);

            $listing->listingSeo->delete();
        }

        foreach ($listing->get_listing_amenities as $lisAmenity) {
            $lisAmenity->delete();
        }

        foreach ($listing->get_business_hour as $business) {
            $business->delete();
        }

        foreach ($listing->get_social_info as $social) {
            $social->delete();
        }

        foreach ($listing->get_reviews as $review) {
            $review->delete();
        }

        foreach ($listing->listingAnalytics as $analytic) {
            $analytic->delete();
        }

        foreach ($listing->allWishlists as $wishlist) {
            $wishlist->delete();
        }

        foreach ($listing->listingViews as $view) {
            $view->delete();
        }

        foreach ($listing->listingClaims as $claim) {
            $claim->delete();
        }

        $listing->delete();
        return back()->with('success', __('Listing has been deleted successfully.'));

    }

    public function listingSingleApproved(Request $request)
    {
        $listing = Listing::with('get_user')->findOrFail($request->listingId);
        $listing->status = 1;
        $listing->save();

        $msg = [
            'userListing' => $listing->title,
            'from' => Auth::user()->name ?? null,
        ];
        $action = [
            "link" => route('user.allListing'),
            "icon" => "fa fa-money-bill-alt text-white"
        ];
        $user = $listing->get_user;
        $this->userPushNotification($user, 'LISTING_APPROVED', $msg, $action);

        session()->flash('success', __('Listing Status Has Been Approved'));
        return response()->json(['success' => 1]);
    }

    public function listingSingleRejected(Request $request)
    {
        $listing = Listing::with('get_user')->findOrFail($request->listingId);
        if ($request->rejectReason == '') {
            session()->flash('error', __('Listing reject reason is required.'));
            return response()->json(['error' => 1]);
        } else {
            $purchase_package = PurchasePackage::findOrFail($listing->purchase_package_id);
            if ($purchase_package->expire_date != null) {
                $expiry_date = $purchase_package->expire_date->format('Y-m-d');
                $current_date = Carbon::now()->format('Y-m-d');
                $no_of_listing = $purchase_package->no_of_listing;

                if ($current_date <= $expiry_date) {
                    $increase = $no_of_listing + 1;
                    $purchase_package->no_of_listing = $increase;
                    $purchase_package->save();
                }
            }

            $msg = [
                'userListing' => $listing->title,
                'rejectReason' => $request->rejectReason,
                'from' => Auth::user()->name ?? null,
            ];
            $action = [
                "link" => route('user.allListing'),
                "icon" => "fa fa-money-bill-alt text-white"
            ];
            $user = $listing->get_user;
            $this->userPushNotification($user, 'LISTING_REJECTED', $msg, $action);

            $listing->status = 2;
            $listing->rejected_reason = $request->rejectReason;
            $listing->save();
            session()->flash('success', __('Listing Status Has Been Rejected'));
            return response()->json(['success' => 1]);
        }
    }

    public function approvedMultiple(Request $request)
    {
        if ($request->strIds == null) {
            session()->flash('error', __('You do not select Listing.'));
            return response()->json(['error' => 1]);
        } else {
            foreach ($request->strIds as $key => $listingId) {
                $listing = Listing::with('get_user')->findOrFail($listingId);
                if ($listing->status == 1) {
                    session()->flash('error', "Already `$listing->title` listing has been approved.");
                    return response()->json(['error' => 1]);
                } elseif ($listing->status == 2) {
                    session()->flash('error', "You can't approved rejected listing! You can deactivate or delete `$listing->title` listing if you wish");
                    return response()->json(['error' => 1]);
                } else {
                    $msg = [
                        'userListing' => $request->userListing[$key],
                        'from' => Auth::user()->name ?? null,
                    ];

                    $action = [
                        "link" => route('user.allListing'),
                        "icon" => "fa fa-money-bill-alt text-white"
                    ];
                    $user = $listing->get_user;
                    $this->userPushNotification($user, 'LISTING_APPROVED', $msg, $action);
                    $listing->status = 1;
                    $listing->save();
                }

            }
            session()->flash('success', __('Listing Status Has Been Approved'));
            return response()->json(['success' => 1]);
        }
    }

    public function rejectedMultiple(Request $request)
    {
        if ($request->strIds == null) {
            session()->flash('error', 'You do not select Listing.');
            return response()->json(['error' => 1]);
        } else {
            if ($request->rejectReason == '') {
                session()->flash('error', __('Listing reject reason is required.'));
                return response()->json(['error' => 1]);
            } else {
                foreach ($request->strIds as $key => $listingId) {
                    $listing = Listing::with('get_user')->findOrFail($listingId);
                    if ($listing->status == 2) {
                        session()->flash('error', "Already `$listing->title` listing has been rejected.");
                        return response()->json(['error' => 1]);
                    } elseif ($listing->status == 1) {
                        session()->flash('error', "You can't rejected approved listing! You can deactivate `$listing->title` listing if you wish");
                        return response()->json(['error' => 1]);
                    } else {
                        $purchase_package = PurchasePackage::findOrFail($listing->purchase_package_id);
                        if ($purchase_package->expire_date != null) {
                            $expiry_date = $purchase_package->expire_date->format('Y-m-d');
                            $current_date = Carbon::now()->format('Y-m-d');
                            $no_of_listing = $purchase_package->no_of_listing;

                            if ($current_date <= $expiry_date) {
                                $increase = $no_of_listing + 1;
                                $purchase_package->no_of_listing = $increase;
                                $purchase_package->save();
                            }
                        }
                        $msg = [
                            'rejectReason' => $request->rejectReason,
                            'userListing' => $request->userListing[$key],
                            'from' => Auth::user()->name ?? null,
                        ];

                        $action = [
                            "link" => route('user.allListing'),
                            "icon" => "fa fa-money-bill-alt text-white"
                        ];
                        $user = $listing->get_user;
                        $this->userPushNotification($user, 'LISTING_REJECTED', $msg, $action);
                    }
                }
                Listing::whereIn('id', $request->strIds)->update([
                    'status' => 2,
                    'rejected_reason' => $request->rejectReason,
                ]);
                session()->flash('success', __('Listing Status Has Been Rejected'));
                return response()->json(['success' => 1]);
            }
        }
    }

    public function listingSettings()
    {
        $data['listingApproval'] = Configure::first();
        $data['packageExpiryCrons'] = PackageExpiryCron::get();
        return view('admin.listing.listingSettings', $data);
    }

    public function listingApprovalStore(Request $request)
    {
        $data = Configure::first();
        $data->listing_approval = $request->listing_approval;
        $data->save();

        $expiryDates = $request->before_expiry_date;

        DB::table('package_expiry_crons')->delete();
        foreach ($expiryDates as $key => $date) {
            $p = new PackageExpiryCron();
            $p->before_expiry_date = $request->before_expiry_date[$key];
            $p->save();
        }
        return back()->with('success', __('Listing Settings Updated!'));
    }

    public function listingActive(Request $request)
    {
        $listing = Listing::with('get_user')->findOrFail($request->listing_id);
        $listing->is_active = 1;
        $listing->save();

        $admin = Auth::user()->name;

        $msg = [
            'listing' => $listing->title ?? null,
            'from' => $admin ?? null,
        ];

        $action = [
            "link" => route('user.allListing'),
            "icon" => "fa fa-money-bill-alt text-white"
        ];
        $user = $listing->get_user;
        $this->userPushNotification($user, 'ACTIVE_LISTING', $msg, $action);

        return back()->with('success', '`' . $listing->title . '`' . ' listing has been activated successfully.');

    }

    public function listingDeactive(Request $request)
    {

        $purifiedData = Purify::clean($request->except('_token', '_method'));

        $rules = [
            'deactive_reason' => 'required',
        ];

        $message = [
            'deactive_reason.required' => __('Please write your listing deactive reason?'),
        ];

        $validate = Validator::make($purifiedData, $rules, $message);

        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }

        $listing = Listing::with('get_user')->findOrFail($request->listing_id);
        $listing->is_active = 0;
        $listing->deactive_reason = $request->deactive_reason;
        $listing->save();

        $admin = Auth::user()->name;

        $msg = [
            'listing' => $listing->title ?? null,
            'from' => $admin ?? null,
        ];

        $action = [
            "link" => route('user.allListing'),
            "icon" => "fa fa-money-bill-alt text-white"
        ];
        $user = $listing->get_user;
        $this->userPushNotification($user, 'DEACTIVE_LISTING', $msg, $action);

        return back()->with('success', '`' . $listing->title . '`' . ' listing has been deactive successfully.');

    }

    public function wishList(Request $request)
    {
        $search = $request->all();
        $fromDate = Carbon::parse($request->from_date);
        $toDate = Carbon::parse($request->to_date)->addDay();
        $data['wishLists'] = Favourite::with(['get_listing.get_user', 'get_user', 'get_listing'])
            ->when(isset($search['name']), function ($query) use ($search) {
                return $query->whereHas('get_listing', function ($query) use ($search) {
                    $query->where('title', 'LIKE', "%{$search['name']}%");
                });
            })
            ->when(isset($search['from_date']), function ($q1) use ($fromDate) {
                return $q1->whereDate('created_at', '>=', $fromDate);
            })
            ->when(isset($search['to_date']), function ($q2) use ($fromDate, $toDate) {
                return $q2->whereBetween('created_at', [$fromDate, $toDate]);
            })
            ->latest()->paginate(config('basic.paginate'));
        return view('admin.listing.wishList', $data);
    }

    public function listingAnalytics(Request $request, $id = null)
    {
        $search = $request->all();
        $fromDate = Carbon::parse($request->from_date);
        $toDate = Carbon::parse($request->to_date)->addDay();

        $data['allAnalytics'] = Analytics::with(['getListing', 'lastVisited:listing_id,created_at'])->withCount('listCount')
            ->when(isset($id), function ($query) use ($id) {
                return $query->where('listing_id', $id);
            })
            ->when(isset($search['listing']), function ($query) use ($search) {
                return $query->whereHas('getListing', function ($query) use ($search) {
                    $query->where('title', 'LIKE', "%{$search['listing']}%");
                });
            })
            ->when(isset($search['from_date']), function ($q2) use ($fromDate) {
                return $q2->whereDate('created_at', '>=', $fromDate);
            })
            ->when(isset($search['to_date']), function ($q2) use ($fromDate, $toDate) {
                return $q2->whereBetween('created_at', [$fromDate, $toDate]);
            })
            ->latest()->groupBy('listing_id')->paginate(config('basic.paginate'));
        return view('admin.listing.analytics', $data);
    }

    public function listingReview(Request $request, $id = null)
    {
        $search = $request->all();
        $fromDate = Carbon::parse($request->from_date);
        $toDate = Carbon::parse($request->to_date)->addDay();

        $data['allReviews'] = UserReview::with(['getListing', 'review_user_info'])
            ->when(isset($search['user']), function ($query) use ($search) {
                return $query->whereHas('review_user_info', function ($q) use ($search) {
                    $q->where('id', 'LIKE', "%{$search['user']}%");
                });
            })
            ->when(!empty($search['rating']), function ($query) use ($search) {
                return $query->whereIn('rating2', $search['rating']);
            })
            ->when(isset($search['from_date']), function ($q2) use ($fromDate) {
                return $q2->whereDate('created_at', '>=', $fromDate);
            })
            ->when(isset($search['to_date']), function ($q2) use ($fromDate, $toDate) {
                return $q2->whereBetween('created_at', [$fromDate, $toDate]);
            })
            ->where('listing_id', $id)
            ->latest()->paginate(config('basic.paginate'));
        $data['listing'] = Listing::findOrFail($id);
        return view('admin.listing.review', $data);
    }

    public function listingReviewDelete($id = null)
    {
        UserReview::findOrFail($id)->delete();
        return back()->with('success', __('delete successfull!'));
    }

    public function showListingAnalytics($id)
    {
        $data['allSingleListingAnalytics'] = Analytics::with(['getListing'])->where('listing_id', $id)->latest()->paginate(config('basic.paginate'));
        $data['listing'] = $data['allSingleListingAnalytics'][0]->getListing->title;
        return view('admin.listing.showSingleAnalytics', $data);
    }

    public function listingAnalyticsDelete($id)
    {
        Analytics::findOrFail($id)->delete();
        return back()->with('success', 'Delete Success!');
    }

    public function wishListDelete($id)
    {
        Favourite::findOrFail($id)->delete();
        return back()->with('success', __('Delete Successfull!'));
    }

    public function productEnquiry(Request $request)
    {
        $data['productEnqueries'] = ProductQuery::with(['get_user', 'get_client', 'get_listing', 'get_product'])->withCount('replies')->latest()
            ->paginate(config('basic.paginate'));
        return view('admin.listing.productEnquiry', $data);
    }

    public function seeProductEnquiryReply($id)
    {
        $data['admin'] = Auth::user();
        $data['singleProductQuery'] = ProductQuery::with(['get_user', 'get_client', 'get_product', 'get_listing.get_user', 'replies'])->findOrFail($id);

        return view('admin.listing.productEnquiryReplies', $data, compact('id'));
    }

    public function productMessageSend(Request $request)
    {
        return back()->with('error', __('You cannot message this conversation. You only have permission to view messages.'));
    }

}


