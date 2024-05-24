<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PaymentController;
use App\Models\Fund;
use App\Models\Gateway;
use App\Models\Package;
use App\Models\PurchasePackage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;
use App\Http\Traits\Notify;
use App\Http\Traits\Upload;

class PricingController extends Controller
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

    public function makePayment(Request $request, $id){
        $data['plan_id'] = $id;
        $data['package'] = Package::with('details')->where('status',1)->findOrFail($id);

        if ($data['package']->isFreePurchase() == 'true'){
            return back()->with('error', 'This package already purchased');
        }

        $package = $data['package'];

        if ($data['package']->price == null){

            $purchase_package = new PurchasePackage();
            $purchase_package->user_id = Auth::id();
            $purchase_package->package_id = $package->id;
            $purchase_package->price = $package->price;
            $purchase_package->is_renew = $package->is_renew;
            $purchase_package->is_image = $package->is_image;
            $purchase_package->is_video = $package->is_video;
            $purchase_package->is_amenities = $package->is_amenities;
            $purchase_package->is_product = $package->is_product;
            $purchase_package->is_business_hour = $package->is_business_hour;
            $purchase_package->no_of_listing = $package->no_of_listing;
            $purchase_package->no_of_img_per_listing = $package->no_of_img_per_listing;
            $purchase_package->no_of_categories_per_listing = $package->no_of_categories_per_listing;
            $purchase_package->no_of_amenities_per_listing = $package->no_of_amenities_per_listing;
            $purchase_package->no_of_product = $package->no_of_product;
            $purchase_package->no_of_img_per_product = $package->no_of_img_per_product;
            $purchase_package->seo = $package->seo;
            $purchase_package->is_whatsapp = $package->is_whatsapp;
            $purchase_package->is_messenger = $package->is_messenger;
            $purchase_package->status = 1;
            $purchase_package->purchase_date = Carbon::now();
            $purchase_package->type = 'Purchase';

            if ($package->expiry_time_type == 'Days' || $package->expiry_time_type == 'Day') {
                $purchase_package->expire_date = Carbon::now()->addDays($package->expiry_time);
            } elseif ($package->expiry_time_type == 'Months' || $package->expiry_time_type == 'Month') {
                $purchase_package->expire_date = Carbon::now()->addMonths($package->expiry_time);
            } elseif ($package->expiry_time_type == 'Years' || $package->expiry_time_type == 'Year') {
                $purchase_package->expire_date = Carbon::now()->addYears($package->expiry_time);
            } else {
                $purchase_package->expire_date = null;
            }

            $purchase_package->save();

            $senderName = $this->user->firstname . ' ' . $this->user->lastname;

            $msg = [
                'package' => optional($package->details)->title,
                'from'    => $senderName,
            ];

            $action = [
                "link" => route('admin.purchasePackageList'),
                "icon" => "fa fa-money-bill-alt text-white"
            ];

            $this->adminPushNotification('PURCHASE_PACKAGE', $msg, $action);
            return redirect()->route('user.myPackages')->with('success', '`'.optional($package->details)->title.'`'. ' has been purchased successfully.');
        }else{
            $data['gateways'] = Gateway::where('status',1)->get();
            return view($this->theme . 'user.makePayment',$data);
        }
    }

    public function makePaymentDetails(Request $request){

        $paymentId = $request->paymentId;
        $packageId = $request->packageId;

        $data['paymentGatewayInfo'] = Gateway::findOrFail($paymentId);
        $data['packageInfo'] = Package::with('details')->where('status', 1)->findOrFail($packageId);

        return response()->json(['data' => $data]);
    }

    public function purchacePlan(Request $request)
    {

        $purifiedData = Purify::clean($request->except( '_token', '_method'));

        $rules = [
            'payment_option.*' => 'required',
        ];

        $message = [
            'payment_option.*.required' => __('Please select payment option.'),
        ];

        $validate = Validator::make($purifiedData, $rules, $message);

        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }

        $package = Package::with('details')->where('status', 1)->findOrFail($request->plan_id);



        $purchase_package = new PurchasePackage();

        $purchase_package->user_id = Auth::id();
        $purchase_package->package_id = $package->id;
        $purchase_package->price = $package->price;
        $purchase_package->is_renew = $package->is_renew;
        $purchase_package->is_image = $package->is_image;
        $purchase_package->is_video = $package->is_video;
        $purchase_package->is_amenities = $package->is_amenities;
        $purchase_package->is_product = $package->is_product;
        $purchase_package->is_business_hour = $package->is_business_hour;
        $purchase_package->no_of_listing = $package->no_of_listing;
        $purchase_package->no_of_img_per_listing = $package->no_of_img_per_listing;
        $purchase_package->no_of_categories_per_listing = $package->no_of_categories_per_listing??null;
        $purchase_package->no_of_amenities_per_listing = $package->no_of_amenities_per_listing;
        $purchase_package->no_of_product = $package->no_of_product;
        $purchase_package->no_of_img_per_product = $package->no_of_img_per_product;
        $purchase_package->seo = $package->seo;
        $purchase_package->is_whatsapp = $package->is_whatsapp;
        $purchase_package->is_messenger = $package->is_messenger;
        $purchase_package->purchase_date = Carbon::now();
        $purchase_package->type = 'Purchase';

        if ($package->expiry_time_type == 'Days' || $package->expiry_time_type == 'Day') {
            $purchase_package->expire_date = Carbon::now()->addDays($package->expiry_time);
        } elseif ($package->expiry_time_type == 'Months' || $package->expiry_time_type == 'Month') {
            $purchase_package->expire_date = Carbon::now()->addMonths($package->expiry_time);
        } elseif ($package->expiry_time_type == 'Years' || $package->expiry_time_type == 'Year') {
            $purchase_package->expire_date = Carbon::now()->addYears($package->expiry_time);
        } else {
            $purchase_package->expire_date = null;
        }

        $purchase_package->save();

        $user = $this->user;

        $gate = Gateway::where('status', 1)->findOrFail($request->gateway);

        $reqAmount = $package->price;
        $charge = getAmount($gate->fixed_charge + ($reqAmount * $gate->percentage_charge / 100));
        $payable = getAmount($reqAmount + $charge);

        $final_amo = getAmount($payable * $gate->convention_rate);

        if ($purchase_package->type == 'Purchase'){
            $remarks = 'Buy ' . $package->details->title;
        }else{
            $remarks = 'Renew ' . $package->details->title;
        }

        $fund = PaymentController::newFund($request, $user, $gate, $charge, $final_amo, $reqAmount, $purchase_package->id, $remarks);
        session()->put('track', $fund['transaction']);

        $senderName = $this->user->firstname . ' ' . $this->user->lastname;

        $msg = [
            'package' => optional($package->details)->title,
            'from'    => $senderName,
        ];

        $action = [
            "link" => route('admin.purchasePackageList'),
            "icon" => "fa fa-money-bill-alt text-white"
        ];

        $packageName = session()->put('packageName', $package->details->title);
        session()->put('renewPackage', __('package_confirm'));

        $this->adminPushNotification('PURCHASE_PACKAGE', $msg, $action);

        return redirect()->route('user.addFund.confirm');

    }

    public function paymentHistory(Request $request, $id){
        $search = $request->all();
        $dateSearch = Carbon::parse($request->datetrx);
        $date = preg_match("/^[0-9]{2,4}\-[0-9]{1,2}\-[0-9]{1,2}$/", $dateSearch);
        $data['packageName'] = PurchasePackage::with(['getPlanInfo.details'])->where('user_id', $this->user->id)->findOrFail($id);

        $data['allTransaction'] = Fund::with(['gateway'])->where('purchase_package_id', $id)->where('user_id', $this->user->id)
            ->when(@$search['transaction_id'], function ($query) use ($search) {
                return $query->where('transaction', 'LIKE', "%{$search['transaction_id']}%");
            })
            ->when(@$search['remark'], function ($query) use ($search) {
                return $query->where('remarks', 'LIKE', "%{$search['remark']}%");
            })
            ->when(@$search['datetrx'], function ($query) use ($dateSearch) {
                return $query->whereDate("created_at", $dateSearch);
            })
            ->orderBy('id', 'DESC')->paginate(config('basic.paginate'));

        return view($this->theme . 'user.paymentHistory', $data);
    }

    public function renewPackage(Request $request, $id){
        $purchasePackage = PurchasePackage::with('getPlanInfo')->where('user_id', $this->user->id)->findOrFail($id);
        $data['plan_id'] = $purchasePackage->package_id;
        $data['purchase_package_id'] = $id;
        $data['package'] = Package::with('details')->where('status', 1)->findOrFail($purchasePackage->package_id);

        if ($purchasePackage->price == null){
            $purchasePackageInfo = $purchasePackage;
            $purchasePackageInfo->type = 'Renew';
            $purchasePackageInfo->save();

            $packageInfo = $data['package'];
            $currentDate = Carbon::now()->format('Y-m-d');
            $expireDate = $purchasePackageInfo->expire_date;

            if ($packageInfo->expiry_time_type == 'Days' || $packageInfo->expiry_time_type == 'Day') {
                if ($currentDate > $expireDate){
                    PurchasePackage::findOrFail($id)->update([
                        'expire_date' => Carbon::now()->addDays($packageInfo->expiry_time),
                    ]);
                }else{
                    PurchasePackage::findOrFail($id)->update([
                        'expire_date' =>  Carbon::parse($expireDate)->addDays($packageInfo->expiry_time),
                    ]);
                }
            }elseif ($packageInfo->expiry_time_type == 'Month' || $packageInfo->expiry_time_type == 'Months'){
                if ($currentDate > $expireDate){
                    PurchasePackage::findOrFail($id)->update([
                        'expire_date' => Carbon::now()->addMonths($packageInfo->expiry_time),
                    ]);
                }else{
                    PurchasePackage::findOrFail($id)->update([
                        'expire_date' => Carbon::parse($expireDate)->addMonths($packageInfo->expiry_time),
                    ]);
                }
            }elseif ($packageInfo->expiry_time_type == 'Year' || $packageInfo->expiry_time_type == 'Years'){
                if ($currentDate > $expireDate){
                    PurchasePackage::findOrFail($id)->update([
                        'expire_date' => Carbon::now()->addYears($packageInfo->expiry_time),
                    ]);
                }else{
                    PurchasePackage::findOrFail($id)->update([
                        'expire_date' => Carbon::parse($expireDate)->addYears($packageInfo->expiry_time),
                    ]);
                }
            }

            $senderName = $this->user->firstname . ' ' . $this->user->lastname;
            $msg = [
                'package' => optional($packageInfo->details)->title,
                'from'    => $senderName,
            ];

            $action = [
                "link" => route('admin.purchasePackageList'),
                "icon" => "fa fa-money-bill-alt text-white"
            ];

            $this->adminPushNotification('RENEW_PACKAGE', $msg, $action);
            return redirect()->route('user.myPackages')->with('success', '`'.optional($packageInfo->details)->title.'`'. ' has been renew successfully.');

        }else{
            $data['gateways'] = Gateway::where('status',1)->get();
            return view($this->theme . 'user.renewPackage',$data);
        }
    }

    public function renewPackageUpdate(Request $request){
        $purchasePackageInfo = PurchasePackage::where('user_id', $this->user->id)->findOrFail($request->purchase_package_id);
        $purchasePackageInfo->type = 'Renew';
        $purchasePackageInfo->save();
        $packageInfo = Package::with('details')->findOrFail($request->plan_id);
        $currentDate = Carbon::now()->format('Y-m-d');
        $expireDate = $purchasePackageInfo->expire_date;

        if ($packageInfo->expiry_time_type == 'Days' || $packageInfo->expiry_time_type == 'Day') {
            if ($currentDate > $expireDate){
                if ($request->gateway <= 999){
                    PurchasePackage::findOrFail($request->purchase_package_id)->update([
                        'expire_date' => Carbon::now()->addDays($packageInfo->expiry_time),
                    ]);
                }
            }else{
                if ($request->gateway <= 999){
                    PurchasePackage::findOrFail($request->purchase_package_id)->update([
                        'expire_date' =>  Carbon::parse($expireDate)->addDays($packageInfo->expiry_time),
                    ]);
                }
            }
        }elseif ($packageInfo->expiry_time_type == 'Month' || $packageInfo->expiry_time_type == 'Months'){
            if ($currentDate > $expireDate){
                if ($request->gateway <= 999){
                    PurchasePackage::findOrFail($request->purchase_package_id)->update([
                        'expire_date' => Carbon::now()->addMonths($packageInfo->expiry_time),
                    ]);
                }
            }else{
                if ($request->gateway <= 999){
                    PurchasePackage::findOrFail($request->purchase_package_id)->update([
                        'expire_date' => Carbon::parse($expireDate)->addMonths($packageInfo->expiry_time),
                    ]);
                }
            }
        }elseif ($packageInfo->expiry_time_type == 'Year' || $packageInfo->expiry_time_type == 'Years'){
            if ($currentDate > $expireDate){
                if ($request->gateway <= 999){
                    PurchasePackage::findOrFail($request->purchase_package_id)->update([
                        'expire_date' => Carbon::now()->addYears($packageInfo->expiry_time),
                    ]);
                }
            }else{
                if ($request->gateway <= 999){
                    PurchasePackage::findOrFail($request->purchase_package_id)->update([
                        'expire_date' => Carbon::parse($expireDate)->addYears($packageInfo->expiry_time),
                    ]);
                }
            }
        }

        $user = $this->user;
        $gate = Gateway::where('status', 1)->findOrFail($request->gateway);
        $reqAmount = $packageInfo->price;
        $charge = getAmount($gate->fixed_charge + ($reqAmount * $gate->percentage_charge / 100));
        $payable = getAmount($reqAmount + $charge);
        $final_amo = getAmount($payable * $gate->convention_rate);

        if ($purchasePackageInfo->type == 'Purchase'){
            $remarks = 'Buy ' . $packageInfo->details->title;
        }else{
            $remarks = 'Renew ' . $packageInfo->details->title;
        }
        $fund = PaymentController::newFund($request, $user, $gate, $charge, $final_amo, $reqAmount, $request->purchase_package_id, $remarks);
        session()->put('track', $fund['transaction']);

        $senderName = $this->user->firstname . ' ' . $this->user->lastname;
        $msg = [
            'package' => $packageInfo->details->title,
            'from'    => $senderName,
        ];

        $action = [
            "link" => route('admin.purchasePackageList'),
            "icon" => "fa fa-money-bill-alt text-white"
        ];

        $this->adminPushNotification('RENEW_PACKAGE', $msg, $action);

        session()->put('renewPackage', __('renew_confirm'));
        session()->put('packageName', $packageInfo->details->title);

        return redirect()->route('user.addFund.confirm');
    }

    public function myPackages(Request $request, $id = null)
    {
        $package_name = $request->name;
        $current_date = Carbon::parse(now()->format('Y-m-d'));
        $purchase_date = Carbon::parse($request->purchase_date);
        $expire_date = Carbon::parse($request->expire_date);
        $status = $request->status;

        $data['my_packages'] = PurchasePackage::with(['get_package', 'getPlanInfo.details','gateway'])
            ->when(isset($id), function ($q) use ($id) {
                $q->where('id', $id);
            })
            ->when(isset($request->name), function ($query) use ($package_name) {

                return $query->whereHas('get_package', function ($q) use ($package_name) {
                    $q->where('title', 'Like', '%' . $package_name . '%');
                });
            })
            ->when(isset($request->purchase_date), function ($query) use ($purchase_date) {
                $query->where('purchase_date', $purchase_date);
            })
            ->when(isset($request->expire_date), function ($query) use ($expire_date) {
                $query->where('expire_date', $expire_date);
            })
            ->when($request->package_status == 'active', function ($query) use ($current_date) {
                $query->whereNull('expire_date')->orWhere('expire_date', '>=', $current_date);
            })
            ->when($request->package_status == 'expired', function ($query) use ($current_date) {
                $query->where('expire_date', '<', $current_date);
            })
            ->when(isset($request->status), function ($q4) use ($status){
                return $q4->where('status', $status);
            })
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(config('basic.paginate'));

        return view($this->theme . 'user.package', $data);
    }

    public function purchasePackageDelete($id)
    {
        $package = PurchasePackage::where('user_id', $this->user->id)->findOrFail($id);
        $package->delete();
        return back()->with('success', __('Package has been deleted'));
    }
}
