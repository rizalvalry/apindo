<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PackageExport;
use App\Exports\PackageExportCsv;
use App\Http\Controllers\Controller;
use App\Http\Traits\Upload;
use App\Http\Traits\Notify;
use App\Models\Language;
use App\Models\PurchasePackage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Configure;
use App\Models\Package;
use App\Models\PackageDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Stevebauman\Purify\Facades\Purify;


class PackageController extends Controller
{
    use Upload, Notify;

    public function package()
    {
        $data['Packages'] = Package::with('details')->orderBy('price', 'ASC')->get();

        return view('admin.package.index', $data);
    }

    public function packageCreate()
    {
        $languages = Language::all();
        $control = Configure::firstOrNew();
        return view('admin.package.create', compact('languages', 'control'));
    }

    public function packageStore(Request $request, $language = null)
    {
        $purifiedData = Purify::clean($request->except('image', '_token', '_method'));
        $purifiedData['image'] = $request->image ?? null;

        $rules = [
            'title.*' => 'required',
            'price' => 'sometimes|required|numeric|not_in:0',
            'is_free' => 'sometimes|required_without:price|integer|in:-1',
            'expiry_time' => 'sometimes|required_without:expiry_time_unlimited|integer|not_in:0',
            'expiry_time_unlimited' => 'sometimes|required_without:expiry_time|integer|in:-1',
            'is_image' => 'sometimes|required|boolean',
            'is_whatsapp' => 'sometimes|required|boolean',
            'is_messenger' => 'sometimes|required|boolean',
            'is_video' => 'sometimes|required|boolean',
            'is_amenities' => 'sometimes|required|boolean',
            'is_product' => 'sometimes|required|boolean',
            'is_business_hour' => 'sometimes|required|boolean',
            'no_of_listing' => 'sometimes|required_without:no_of_listing_unlimited|integer|not_in:0',
            'no_of_listing_unlimited' => 'sometimes|required_without:no_of_listing|integer|in:-1',
            'no_of_img_per_listing' => 'exclude_if:is_image,0|sometimes|required_without:no_of_img_per_listing_unlimited|integer|not_in:0',
            'no_of_img_per_listing_unlimited' => 'exclude_if:is_image,0|sometimes|required_without:no_of_img_per_listing|integer|in:-1',
            'no_of_amenities_per_listing' => 'exclude_if:is_amenities,0|sometimes|required_without:no_of_amenities_per_listing_unlimited|integer|not_in:0',
            'no_of_categories_per_listing' => 'min:1|numeric|not_in:0',
            'no_of_amenities_per_listing_unlimited' => 'exclude_if:is_amenities,0|sometimes|required_without:no_of_amenities_per_listing|integer|in:-1',
            'no_of_product' => 'exclude_if:is_product,0|sometimes|required_without:no_of_product_unlimited|integer|not_in:0',
            'no_of_product_unlimited' => 'exclude_if:is_product,0|sometimes|required_without:no_of_product|integer|in:-1',
            'no_of_img_per_product' => 'exclude_if:is_product,0|sometimes|required_without:no_of_img_per_product_unlimited|integer|not_in:0',
            'no_of_img_per_product_unlimited' => 'exclude_if:is_product,0|sometimes|required_without:no_of_img_per_product|integer|in:-1',
            'seo' => 'sometimes|required',
            'status' => 'sometimes|required',
            'image' => 'required|mimes:jpg,jpeg,png'
        ];

        $message = [
            'title.*.required' => __('Package title is required'),
            'price.required' => __('Price field is required'),
            'is_free.required_without' => __('price field is required'),
            'expiry_time.required' => __('Package expiry field is required'),
            'is_image.required' => __('please select image field'),
            'is_video.required' => __('please select video field'),
            'is_amenities.required' => __('please select amenities field'),
            'is_product.required' => __('please select product field'),
            'is_business_hour.required' => __('please select business hour field'),
            'no_of_listing.required_without' => __('No of listing field is required'),
            'no_of_listing_unlimited.required_without' => __('No of listing field is required'),
            'no_of_img_per_listing.required_without' => __('No of img per listing is required'),
            'no_of_img_per_listing_unlimited.required_without' => __('No of img per listing is required'),
            'no_of_amenities_per_listing.required_without' => __('No of amenities per listing is required'),
            'no_of_amenities_per_listing_unlimited.required_without' => __('No of amenities per listing is required'),
            'no_of_product.required_without' => __('No of product is required'),
            'no_of_product_unlimited.required_without' => __('No of product is required'),
            'no_of_img_per_product.required_without' => __('No of img per product is required'),
            'no_of_img_per_product_unlimited.required_without' => __('No of img per product is required'),
            'seo.required' => __('Seo is required'),
            'status.required' => __('Status is required'),
            'image.required' => __('Image is required'),
        ];

        $validate = Validator::make($purifiedData, $rules, $message);

        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }

        $package = new Package();

        $package->price = isset($request->is_free) && $request->is_free == -1 ? null : $request->price;
        $package->is_multiple_time_purchase = isset($request->is_free) && $request->is_free == -1 ? $request->is_multiple_time_purchase : 0;
        $package->expiry_time_type = isset($request->expiry_time_unlimited) && $request->expiry_time_unlimited == -1 ? null : $request->expiry_time_type;

        if ($request->expiry_time) {
            $package->expiry_time = $request->expiry_time;
            if ($request->expiry_time == 1 && $request->expiry_time_type == 'Days') {
                $package->expiry_time_type = 'Day';
            } elseif ($request->expiry_time == 1 && $request->expiry_time_type == 'Months') {
                $package->expiry_time_type = 'Month';
            } elseif ($request->expiry_time == 1 && $request->expiry_time_type == 'Years') {
                $package->expiry_time_type = 'Year';
            } else {
                $package->expiry_time_type = $request->expiry_time_type;
            }
        }

        $package->is_renew = $request->is_renew ? $request->is_renew : 0;
        $package->is_image = $request->is_image;
        $package->is_video = $request->is_video;
        $package->is_amenities = $request->is_amenities;
        $package->is_product = $request->is_product;
        $package->is_business_hour = $request->is_business_hour;
        $package->no_of_listing = isset($request->no_of_listing_unlimited) && $request->no_of_listing_unlimited == -1 ? null : $request->no_of_listing;
        $package->no_of_img_per_listing = isset($request->no_of_img_per_listing_unlimited) && $request->no_of_img_per_listing_unlimited == -1 && $request->is_image == 0 ? null : $request->no_of_img_per_listing;
        $package->no_of_amenities_per_listing = isset($request->no_of_amenities_per_listing_unlimited) && $request->no_of_amenities_per_listing_unlimited == -1 && $request->is_amenities == 0 ? null : $request->no_of_amenities_per_listing;
        $package->no_of_categories_per_listing = $request->no_of_categories_per_listing;
        $package->no_of_product = isset($request->no_of_product_unlimited) && $request->no_of_product_unlimited == -1 && $request->is_product == 0 ? null : $request->no_of_product;
        $package->no_of_img_per_product = isset($request->no_of_img_per_product_unlimited) && $request->no_of_img_per_product_unlimited == -1 && $request->is_product == 0 ? null : $request->no_of_img_per_product;
        $package->seo = $request->seo;
        $package->is_whatsapp = $request->is_whatsapp;
        $package->is_messenger = $request->is_messenger;
        $package->status = $request->status;

        if ($request->hasFile('image')) {
            try {
                $image = $this->fileUpload($purifiedData['image'], config('location.package.path'), $package->driver, null, null);
                if ($image) {
                    $package->image = $image['path'];
                    $package->driver = $image['driver'];
                }
            } catch (\Exception $exp) {
                return back()->with('error', __('Image could not be uploaded.'));
            }
        }

        $package->save();

        $package->details()->create([
            'language_id' => $language,
            'title' => $purifiedData["title"][$language],
        ]);

        return back()->with('success', __('Package Saved Successfully.'));
    }

    public function packageEdit($id)
    {
        $languages = Language::all();
        $packageDetails = PackageDetails::with('package')->where('package_id', $id)->get()->groupBy('language_id');

        return view('admin.package.edit', compact('languages', 'packageDetails', 'id'));
    }

    public function packageUpdate(Request $request, $id, $language_id)
    {
        $purifiedData = Purify::clean($request->except('image', '_token', '_method'));
        $purifiedData['image'] = $request->image ?? null;

        $rules = [
            'title.*' => 'required',
            'price' => 'sometimes|required|numeric|not_in:0',
            'is_free' => 'sometimes|required_without:price|integer|in:-1',
            'expiry_time' => 'sometimes|required_without:expiry_time_unlimited|integer|not_in:0',
            'expiry_time_unlimited' => 'sometimes|required_without:expiry_time|integer|in:-1',
            'is_image' => 'sometimes|required|boolean',
            'is_video' => 'sometimes|required|boolean',
            'is_amenities' => 'sometimes|required|boolean',
            'is_product' => 'sometimes|required|boolean',
            'is_business_hour' => 'sometimes|required|boolean',
            'no_of_listing' => 'sometimes|required_without:no_of_listing_unlimited|integer|not_in:0',
            'no_of_listing_unlimited' => 'sometimes|required_without:no_of_listing|integer|in:-1',
            'no_of_img_per_listing' => 'exclude_if:is_image,0|sometimes|required_without:no_of_img_per_listing_unlimited|integer|not_in:0',
            'no_of_img_per_listing_unlimited' => 'exclude_if:is_image,0|sometimes|required_without:no_of_img_per_listing|integer|in:-1',
            'no_of_amenities_per_listing' => 'exclude_if:is_amenities,0|sometimes|required_without:no_of_amenities_per_listing_unlimited|integer|not_in:0',
            'no_of_categories_per_listing' => 'min:1|numeric|not_in:0',
            'no_of_amenities_per_listing_unlimited' => 'exclude_if:is_amenities,0|sometimes|required_without:no_of_amenities_per_listing|integer|in:-1',
            'no_of_product' => 'exclude_if:is_product,0|sometimes|required_without:no_of_product_unlimited|integer|not_in:0',
            'no_of_product_unlimited' => 'exclude_if:is_product,0|sometimes|required_without:no_of_product|integer|in:-1',
            'no_of_img_per_product' => 'exclude_if:is_product,0|sometimes|required_without:no_of_img_per_product_unlimited|integer|not_in:0',
            'no_of_img_per_product_unlimited' => 'exclude_if:is_product,0|sometimes|required_without:no_of_img_per_product|integer|in:-1',
            'seo' => 'sometimes|required',
            'status' => 'sometimes|required',
        ];

        $message = [
            'title.*.required' => __('Package title is required'),
            'price.required' => __('Price field is required'),
            'is_free.required_without' => __('price field is required'),
            'expiry_time.required' => __('Package expiry field is required'),
            'is_image.required' => __('please select image field'),
            'is_video.required' => __('please select video field'),
            'is_amenities.required' => __('please select amenities field'),
            'is_product.required' => __('please select product field'),
            'is_business_hour.required' => __('please select business hour field'),
            'no_of_listing.required_without' => __('No of listing field is required'),
            'no_of_listing_unlimited.required_without' => __('No of listing field is required'),
            'no_of_img_per_listing.required_without' => __('No of img per listing is required'),
            'no_of_img_per_listing_unlimited.required_without' => __('No of img per listing is required'),
            'no_of_amenities_per_listing.required_without' => __('No of amenities per listing is required'),
            'no_of_amenities_per_listing_unlimited.required_without' => __('No of amenities per listing is required'),
            'no_of_product.required_without' => __('No of product is required'),
            'no_of_product_unlimited.required_without' => __('No of product is required'),
            'no_of_img_per_product.required_without' => __('No of img per product is required'),
            'no_of_img_per_product_unlimited.required_without' => __('No of img per product is required'),
            'seo.required' => __('Seo is required'),
            'status.required' => __('Status is required'),
        ];

        $validate = Validator::make($purifiedData, $rules, $message);

        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }

        $package = Package::findOrFail($id);
        $package->price = isset($request->is_free) && $request->is_free == -1 ? null : $request->price;
        $package->is_multiple_time_purchase = isset($request->is_free) && $request->is_free == -1 ? $request->is_multiple_time_purchase : 0;

        if ($request->hasFile('image')) {
            try {
                $package->image = $this->fileUpload($purifiedData['image'], config('location.package.path'), $package->driver, null, null);

            } catch (\Exception $exp) {
                return back()->with('error', __('Image could not be uploaded.'));
            }
        }

        if($request->has('expiry_time_unlimited')) {
            $package->expiry_time_type = isset($request->expiry_time_unlimited) && $request->expiry_time_unlimited == -1 ? null : $request->expiry_time_type;
            $package->expiry_time = null;
        }

        if ($request->expiry_time) {
            $package->expiry_time = $request->expiry_time;
            if ($request->expiry_time == 1 && $request->expiry_time_type == 'Days') {
                $package->expiry_time_type = 'Day';
            } elseif ($request->expiry_time == 1 && $request->expiry_time_type == 'Months') {
                $package->expiry_time_type = 'Month';
            } elseif ($request->expiry_time == 1 && $request->expiry_time_type == 'Years') {
                $package->expiry_time_type = 'Year';
            } else {
                $package->expiry_time_type = $request->expiry_time_type;
            }
        }

        if ($request->has('is_renew')) {
            $package->is_renew = $request->is_renew ? $request->is_renew : 0;
        }
        if ($request->has('is_image')) {
            $package->is_image = $request->is_image;
        }
        if ($request->has('is_video')) {
            $package->is_video = $request->is_video;
        }
        if ($request->has('is_amenities')) {
            $package->is_amenities = $request->is_amenities;
        }
        if ($request->has('is_product')) {
            $package->is_product = $request->is_product;
        }
        if ($request->has('is_business_hour')) {
            $package->is_business_hour = $request->is_business_hour;
        }
        if ($request->has('no_of_listing')) {
            $package->no_of_listing = $request->no_of_listing;
        }else{
            $package->no_of_listing = isset($request->no_of_listing_unlimited) && $request->no_of_listing_unlimited == -1 ? null : $request->no_of_listing;
        }
        if ($request->has('no_of_img_per_listing')) {
            $package->no_of_img_per_listing = $request->no_of_img_per_listing;
        }else{
            $package->no_of_img_per_listing = isset($request->no_of_img_per_listing_unlimited) && $request->no_of_img_per_listing_unlimited == -1 ? null : $request->no_of_img_per_listing;
        }
        if ($request->has('no_of_amenities_per_listing')) {
            $package->no_of_amenities_per_listing = $request->no_of_amenities_per_listing;
        }else{
            $package->no_of_amenities_per_listing = isset($request->no_of_amenities_per_listing_unlimited) && $request->no_of_amenities_per_listing_unlimited == -1 ? null : $request->no_of_amenities_per_listing;
        }
        if ($request->has('no_of_product')) {
            $package->no_of_product = isset($request->no_of_product) && $request->is_product == 0 ? null : $request->no_of_product;
        }else{
            $package->no_of_product = isset($request->no_of_product_unlimited) && $request->no_of_product_unlimited == -1 && $request->is_product == 0 ? null : $request->no_of_product;
        }
        if ($request->has('no_of_img_per_product')) {
            $package->no_of_img_per_product = isset($request->no_of_img_per_product) && $request->is_product == 0 ? null : $request->no_of_img_per_product;
        }else{
            $package->no_of_img_per_product = isset($request->no_of_img_per_product_unlimited) && $request->no_of_img_per_product_unlimited == -1 && $request->is_product == 0 ? null : $request->no_of_img_per_product;
        }

        if ($request->has('seo')) {
            $package->seo = $request->seo;
        }
        if ($request->has('is_whatsapp')) {
            $package->is_whatsapp = $request->is_whatsapp;
        }
        if ($request->has('is_messenger')) {
            $package->is_messenger = $request->is_messenger;
        }

        if ($request->has('status')) {
            $package->status = $request->status;
        }
        if ($request->hasFile('image')) {
            try {
                $image = $this->fileUpload($purifiedData['image'], config('location.package.path'), $package->driver, null, null);
                if ($image) {
                    $package->image = $image['path'];
                    $package->driver = $image['driver'];
                }
            } catch (\Exception $exp) {
                return back()->with('error', __('Image could not be uploaded.'));
            }
        }

        $package->no_of_categories_per_listing = $request->no_of_categories_per_listing;
        $package->save();

        $package->details()->updateOrCreate([
            'language_id' => $language_id
        ],
            [
                'title' => $purifiedData["title"][$language_id],
            ]
        );

        return back()->with('success', __('Package Update Successfully.'));
    }

    public function packageDelete($id)
    {
        $package = Package::findOrFail($id);
        $old_image = $package->image;

        if (!empty($old_image)) {
        $this->fileDelete($package->driver, $old_image);
        }

        $package->delete();
        return back()->with('success', __('Package has been deleted'));
    }

    public function purchasePackageList(Request $request)
    {
        $data['packages'] = Package::with('details')->latest()->get();
        $data['allDistinctUsers'] = PurchasePackage::with('get_user')->distinct()->get('user_id');
        $search = $request->all();
        $fromDate = Carbon::parse($request->from_date);
        $toDate = Carbon::parse($request->to_date)->addDay();
        $current_date = Carbon::parse(now()->format('Y-m-d'));
        $data['all_purchase_packages'] = PurchasePackage::with(['get_user', 'getPlanInfo.details'])
            ->when(isset($search['user']), function ($query) use ($search) {
                return $query->whereHas('get_user', function ($q) use ($search) {
                    $q->where('id', 'LIKE', "%{$search['user']}%");
                });
            })
            ->when(isset($search['package']), function ($query) use ($search) {
                return $query->whereHas('getPlanInfo', function ($q2) use ($search) {
                    $q2->where('id', 'LIKE', "%{$search['package']}%");
                });
            })
            ->when(isset($search['from_date']), function ($q3) use ($fromDate) {
                return $q3->whereDate('created_at', '>=', $fromDate);
            })
            ->when(isset($search['to_date']), function ($q4) use ($fromDate, $toDate) {
                return $q4->whereBetween('created_at', [$fromDate, $toDate]);
            })
            ->when($request->package_status == 'active', function ($query) use ($current_date) {
                $query->whereNull('expire_date')->orWhere('expire_date', '>=', $current_date);
            })
            ->when($request->package_status == 'expired', function ($query) use ($current_date) {
                $query->where('expire_date', '<', $current_date);
            })
            ->when(isset($search['status']), function ($q5) use ($search) {
                return $q5->where('status', $search['status']);
            })
            ->orderBy('id', 'desc')->paginate(config('basic.paginate'));

        return view('admin.package.purchasePackageList', $data);
    }

    public function userPurchasePackageDelete($id)
    {
        PurchasePackage::findOrFail($id)->delete();
        return back()->with('success', __('Pacakge Delete Successfully!'));
    }

    public function approvedMultiple(Request $request)
    {
        if ($request->strIds == null) {
            session()->flash('error', __('You do not select package.'));
            return response()->json(['error' => 1]);
        } else {

            PurchasePackage::whereIn('id', $request->strIds)->update([
                'status' => 1,
            ]);

            foreach ($request->strIds as $key => $purchasePackageId) {
                $msg = [
                    'userPackage' => $request->userPackage[$key],
                    'from' => Auth::user()->name ?? null,
                ];

                $action = [
                    "link" => route('user.myPackages'),
                    "icon" => "fa fa-money-bill-alt text-white"
                ];

                $purchasePackage = PurchasePackage::with('get_user')->findOrFail($purchasePackageId);
                $user = $purchasePackage->get_user;
                $this->userPushNotification($user, 'PACKAGE_APPROVED', $msg, $action);
            }

            session()->flash('success', __('Package status has been approved'));
            return response()->json(['success' => 1]);
        }
    }

    public function cancelMultiple(Request $request)
    {
        if ($request->strIds == null) {
            session()->flash('error', __('You do not select package.'));
            return response()->json(['error' => 1]);
        } else {
            if ($request->cancelReason == '') {
                session()->flash('error', __('Package cancel reason is required.'));
                return response()->json(['error' => 1]);
            } else {
                PurchasePackage::whereIn('id', $request->strIds)->update([
                    'status' => 2,
                ]);

                foreach ($request->strIds as $key => $purchasePackageId) {
                    $msg = [
                        'cancelReason' => $request->cancelReason,
                        'userPackage' => $request->userPackage[$key],
                        'from' => Auth::user()->name ?? null,
                    ];

                    $action = [
                        "link" => route('user.myPackages'),
                        "icon" => "fa fa-money-bill-alt text-white"
                    ];

                    $purchasePackage = PurchasePackage::with('get_user')->findOrFail($purchasePackageId);
                    $user = $purchasePackage->get_user;
                    $this->userPushNotification($user, 'PACKAGE_CANCELLED', $msg, $action);
                }

                session()->flash('success', __('Package status has been cancel'));
                return response()->json(['success' => 1]);
            }
        }
    }

    public function deleteMultiple(Request $request)
    {
        $selectedPackageId = $request->package_id;
        $packageIdArray = explode(",", $selectedPackageId);
        if ($packageIdArray != '') {
            foreach ($packageIdArray as $id) {
                PurchasePackage::findOrFail($id)->delete();
            }
        }
        return back()->with('success', 'Package deleted successfully!');
    }

    public function exportPackageExcel(Request $request)
    {
        return Excel::download(new PackageExport($request->package_id), 'purchased_package.xlsx');
    }

    public function exportPackageCsv(Request $request)
    {
        return Excel::download(new PackageExportCsv($request->package_id), 'purchased_package.csv');
    }


}
