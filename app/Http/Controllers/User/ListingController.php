<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\ListingTrait;
use App\Models\BusinessHour;
use App\Models\Configure;
use App\Models\Favourite;
use App\Models\ListingAminity;
use App\Models\ListingApproval;
use App\Models\ListingImage;
use App\Models\ListingSeo;
use App\Models\Product;
use App\Models\UserReview;
use App\Models\WebsiteAndSocial;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Traits\Notify;
use App\Http\Traits\Upload;
use App\Models\Amenity;
use App\Models\Listing;
use App\Models\ListingCategory;
use App\Models\Package;
use App\Models\Place;
use App\Models\PurchasePackage;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;

class ListingController extends Controller
{
    use Upload, Notify, ListingTrait;

    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            return $next($request);
        });
        $this->theme = template();
    }

    public function listing(Request $request, $type = null)
    {
        $types = ['pending', 'approved', 'rejected'];
        abort_if(isset($type) && !in_array($type, $types), 404);
        $current_user = $this->user;
        $data['packages'] = Package::with('details')->where('status', 1)->latest()->get();
        $data['listingCategories'] = ListingCategory::with('details')->where('status', 1)->latest()->get();
        $data['allAddresses'] = Place::with('details')->where('status', 1)->latest()->get();

        $data['my_packages'] = PurchasePackage::with('get_package')->where('user_id', auth()->id())->get();

        $search = $request->all();
        $categoryIds = $request->category;

        $data['user_listings'] = Listing::with(['get_package.get_package', 'get_place.details'])->latest()
            ->when(isset($categoryIds), function ($query) use ($categoryIds) {
                if (implode('',$categoryIds) == 'all'){
                    $query->where('status', 1)->where('is_active', 1);
                }else{
                    foreach ($categoryIds as $key => $category_id) {
                        $query->whereJsonContains('category_id', $category_id);
                    }
                }
            })
            ->when(isset($search['name']), function ($query) use ($search) {
                return $query->where('title', 'LIKE', "%{$search['name']}%");
            })
            ->when(isset($search['package']), function ($query) use ($search) {
                return $query->whereHas('get_package', function ($q) use ($search) {
                    $q->where('package_id', $search['package']);
                });
            })
            ->when(isset($search['location']), function ($query) use ($search) {
                return $query->whereHas('get_place', function ($q3) use ($search) {
                    $q3->where('id', $search['location']);
                });
            })
            ->when($type == 'pending', function ($query) {
                return $query->where('status', '0');
            })
            ->when($type == 'approved', function ($query) {
                return $query->where('status', '1');
            })
            ->when($type == 'rejected', function ($query) {
                return $query->where('status', '2');
            })
            ->where('user_id', $current_user->id)
            ->paginate(config('basic.paginate'));

        return view($this->theme . 'user.listing', $data);
    }

    public function reviews(Request $request, $id)
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

        $data['listing'] = Listing::where('user_id', $this->user->id)->findOrFail($id);
        return view($this->theme . 'user.reviews', $data);
    }

    public function addListing($id)
    {
        $data['all_listings_category'] = ListingCategory::with('details')->where('status', 1)->latest()->get();
        $data['all_places'] = Place::with('details')->where('status', 1)->latest()->get();
        $data['all_amenities'] = Amenity::with('details')->where('status', 1)->latest()->get();

        $data['single_package_infos'] = PurchasePackage::with('get_package')->where('user_id', $this->user->id)->where('status', 1)->findOrFail($id);
        return view($this->theme . 'user.addListing', $data, compact('id'));
    }

    public function listingStore(Request $request, $id)
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

        $purchase_package_info = PurchasePackage::where('user_id', $this->user->id)->where('status', 1)->findOrFail($id);

        $user = $this->user;

        if (!empty($purchase_package_info->no_of_listing) && $purchase_package_info->no_of_listing <= 0)
            return back()->with('error', __("You don't have any quota to create listing for this package."));

        $listing = new Listing();
        if ($request->hasFile('thumbnail')) {
            try {
                $image = $this->fileUpload($request->thumbnail, config('location.listing_thumbnail.path'), $listing->driver, null);
                if ($image) {
                    $listing->thumbnail = $image['path'];
                    $listing->driver = $image['driver'];
                }
            } catch (\Exception $exp) {
                return back()->with('error', __('Thumbnail could not be uploaded.'));
            }
        }

        $listing->user_id = $user->id;
        $listing->purchase_package_id = $id;
        $listing->title = $request->title;


        $numberOfCategoriesPerListing = min(count($request->category_id), $purchase_package_info->no_of_categories_per_listing ?? 1);
        $listing->category_id = array_slice($request->category_id, 0, $numberOfCategoriesPerListing);

        $listing->phone = $request->phone;
        $listing->email = $request->email;
        $listing->description = $request->description;
        $listing->place_id = $request->place_id;
        $listing->address = $request->address;
        $listing->lat = $request->lat;
        $listing->long = $request->long;
        $listing->status = 0;

        if($purchase_package_info->is_whatsapp == 1 || $purchase_package_info->is_messenger == 1){
            $listing->fb_app_id = $request->fb_app_id;
            $listing->fb_page_id = $request->fb_page_id;
            $listing->whatsapp_number = $request->whatsapp_number;
            $listing->replies_text = $request->replies_text;
            $listing->body_text = $request->body_text;
        }

        if ($request->youtube_video_id) {
            $listing->youtube_video_id = $request->youtube_video_id;
        }

        $listing->save();

        if ($purchase_package_info->is_business_hour && !empty($request->working_day)) {
            $this->insertBusinessHours($request, $listing, $id);
        }

        if (!empty($request->social_icon)) {
            $this->insertSocialAndWebsite($request, $listing, $id);
        }

        if ($purchase_package_info->is_image && !empty($request->listing_image)) {
            $numberOfImgPerListing = min(count($request->listing_image), $purchase_package_info->no_of_img_per_listing ?? 500);
            $this->uploadListingImages($numberOfImgPerListing, $request, $listing, $id);
        }

        if ($purchase_package_info->is_amenities && !empty($request->amenity_id)) {
            $numberOfAmenitiesPerListing = min(count($request->amenity_id), $purchase_package_info->no_of_amenities_per_listing ?? 500);
            $this->insertAmenitites($numberOfAmenitiesPerListing, $request, $listing, $id);
        }

        if ($purchase_package_info->is_product && !empty($request->product_title)) {
            $numberOfProductsPerListing = min(count($request->product_title), $purchase_package_info->no_of_product ?? 500);
            $this->uploadProducts($request, $listing, $numberOfProductsPerListing);
        }

        if ($purchase_package_info->seo && ($request->meta_title || $request->meta_description || $request->meta_keywords || $request->seo_image)) {
            $this->insertSEO($listing, $request, $id);
        }

        if ($purchase_package_info->no_of_listing != null) {
            $purchase_package_info->update([
                'no_of_listing' => $purchase_package_info->no_of_listing - 1,
            ]);
        }

        $userName = $this->user->firstname . ' ' . $this->user->lastname;
        $msg = [
            'from' => $userName ?? null,
        ];

        $action = [
            "link" => route('admin.viewListings'),
            "icon" => "fa fa-money-bill-alt text-white"
        ];

        $this->adminPushNotification('Create_Listing', $msg, $action);

        $listingApproval = Configure::first();

        if ($listingApproval->listing_approval == 1) {
            return redirect()->route('user.allListing')->with('success', __('Your listing has been created successfully! Admin approval is required to view the listing'));
        } else {
            Listing::findOrFail($listing->id)->update([
                'status' => 1,
            ]);
            return back()->with('success', __('Your listing has been created successfully!'));
        }
    }


    public function editListing($id)
    {
        $data['single_listing_infos'] = Listing::where('user_id', $this->user->id)->findOrFail($id);
        $data['single_package_infos'] = PurchasePackage::with('get_package')->where('status', 1)->findOrFail($data['single_listing_infos']->purchase_package_id);

        if ($data['single_listing_infos']->status == 2) {
            return redirect()->route('user.allListing', 'rejected');
        }

        $data['all_listings_category'] = ListingCategory::with('details')->where('status', 1)->latest()->get();
        $data['all_places'] = Place::with('details')->where('status', 1)->latest()->get();
        $data['all_amenities'] = Amenity::with('details')->where('status', 1)->latest()->get();
        $data['listing_aminities'] = ListingAminity::select('amenity_id')->where('listing_id', $id)->pluck('amenity_id')->toArray();
        $data['listing_seos'] = ListingSeo::where('listing_id', $id)->first();
        $data['listing_products'] = Product::with('get_product_image')->where('listing_id', $id)->get();
        $data['listing_seo'] = ListingSeo::where('listing_id', $id)->first();
        $data['business_hours'] = BusinessHour::where('listing_id', $id)->get();
        $data['social_links'] = WebsiteAndSocial::where('listing_id', $id)->get();
        $data['listing_images'] = ListingImage::where('listing_id', $id)->get()->map(function ($image){
            $image->src = getFile($image->driver, $image->listing_image);
            return $image;
        });

        return view($this->theme . 'user.editListing', $data, compact('id'));
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

        $user = $this->user;
        $listing = Listing::has('get_package')->with('get_package')->where('user_id', $this->user->id)->findOrFail($id);

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

        $listing->user_id = $user->id;
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

    public function listingDelete($id)
    {
        $listing = Listing::with(['get_package', 'listingImages', 'get_listing_amenities', 'get_business_hour', 'get_social_info', 'get_products', 'listingSeo', 'get_reviews', 'listingAnalytics', 'listingClaims', 'allWishlists', 'productQueries.replies', 'listingViews'])->where('user_id', $this->user->id)->findOrFail($id);

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
        foreach ($allProductQueries as $query){
            foreach ($query->replies as $reply){
                $this->fileDelete($reply->driver, $reply->file);
                $reply->delete();
            }
            $query->delete();
        }

        if(optional($listing->listingSeo)->seo_image){
            $this->fileDelete(optional($listing->listingSeo)->driver, optional($listing->listingSeo)->seo_image);
            optional($listing->listingSeo)->delete();
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

    public function wishList(Request $request)
    {
        $search = $request->all();
        $fromDate = Carbon::parse($request->from_date);
        $toDate = Carbon::parse($request->to_date)->addDay();

        $data['favourite_listings'] = Favourite::with(['get_listing'])
            ->when(isset($search['name']), function ($query) use ($search) {
                return $query->whereHas('get_listing', function ($query) use ($search) {
                    $query->where('title', 'LIKE', "%{$search['name']}%");
                });
            })
            ->when(isset($search['from_date']), function ($q2) use ($fromDate) {
                return $q2->whereDate('created_at', '>=', $fromDate);
            })
            ->when(isset($search['to_date']), function ($q2) use ($fromDate, $toDate) {
                return $q2->whereBetween('created_at', [$fromDate, $toDate]);
            })
            ->where('client_id', $this->user->id)
            ->latest()
            ->paginate(config('basic.paginate'));
        return view($this->theme . 'user.wishList', $data);
    }

    public function favouriteListingDelete($id)
    {

        Favourite::where('client_id', $this->user->id)->findOrfail($id)->delete();
        return back()->with('success', __('Delete Successful!'));
    }
}
