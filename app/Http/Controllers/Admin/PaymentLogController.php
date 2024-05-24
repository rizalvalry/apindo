<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Notify;
use App\Models\Fund;
use App\Models\PurchasePackage;
use Carbon\Carbon;
use Facades\App\Services\BasicService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Stevebauman\Purify\Facades\Purify;

class PaymentLogController extends Controller
{
    use Notify;

    public function index($id=null)
    {
        $page_title = "Payment Logs";
        $funds = Fund::where('status', '!=', 0)->orderBy('id', 'DESC')->with('user', 'gateway', 'purchasePackage')
            ->when(isset($id), function ($query) use ($id){
                $query->whereHas('purchasePackage', function ($query2) use ($id){
                    $query2->where('id', $id);
                });
            })
            ->paginate(config('basic.paginate'));
        return view('admin.payment.logs', compact('funds', 'page_title'));
    }

    public function pending($id=null)
    {
        $page_title = "Payment Pending";
        $funds = Fund::where('status', 2)->where('gateway_id', '>', 999)->orderBy('id', 'DESC')->with('user', 'gateway', 'purchasePackage')
            ->when(isset($id), function ($query) use ($id){
                $query->whereHas('purchasePackage', function ($query2) use ($id){
                   $query2->where('id', $id);
                });
            })
            ->paginate(config('basic.paginate'));
        return view('admin.payment.logs', compact('funds', 'page_title'));
    }

    public function search(Request $request)
    {

        $search = $request->all();
        $dateSearch = Carbon::parse($request->date_time);

        $funds = Fund::with(['user', 'gateway'])
            ->when(isset($search['name']), function ($query) use ($search) {
            return $query->where('transaction', 'LIKE', $search['name'])
                ->orWhereHas('user', function ($q) use ($search) {
                    $q->where('email', 'LIKE', "%{$search['name']}%")
                        ->orWhere('username', 'LIKE', "%{$search['name']}%");
                });
            })
            ->when(isset($search['status']), function ($query3) use ($search){
                $query3->where('status', $search['status']);
            })
            ->when(isset($search['date_time']), function ($query4) use ($dateSearch){
                $query4->whereDate('created_at', $dateSearch);
            })
            ->latest()
            ->paginate(config('basic.paginate'));
        $funds->appends($search);
        $page_title = "Search Payment Logs";
        return view('admin.payment.logs', compact('funds', 'page_title'));
    }


    public function action(Request $request, $id)
    {
        $data = Fund::where('id', $request->id)->whereIn('status', [2])->with(['user', 'gateway', 'purchasePackage.getPlanInfo.details'])->firstOrFail();

        $planName = optional($data->purchasePackage->getPlanInfo->details)->title;
        $expireDate = $data->purchasePackage->expire_date;
        $currentDate = Carbon::now()->format('Y-m-d');

        if ($data->purchasePackage->getPlanInfo->expiry_time_type == 'Days' || $data->purchasePackage->getPlanInfo->expiry_time_type == 'Day') {

            if ($currentDate > $expireDate){
                PurchasePackage::findOrFail($data->purchasePackage->id)->update([
                    'expire_date' => Carbon::now()->addDays($data->purchasePackage->getPlanInfo->expiry_time),
                ]);
            }else{
                PurchasePackage::findOrFail($data->purchasePackage->id)->update([
                    'expire_date' =>  Carbon::parse($expireDate)->addDays($data->purchasePackage->getPlanInfo->expiry_time),
                ]);
            }
        }elseif ($data->purchasePackage->getPlanInfo->expiry_time_type == 'Month' || $data->purchasePackage->getPlanInfo->expiry_time_type == 'Months'){
            if ($currentDate > $expireDate){
                PurchasePackage::findOrFail($data->purchasePackage->id)->update([
                    'expire_date' => Carbon::now()->addDays($data->purchasePackage->getPlanInfo->expiry_time),
                ]);
            }else{
                PurchasePackage::findOrFail($data->purchasePackage->id)->update([
                    'expire_date' =>  Carbon::parse($expireDate)->addDays($data->purchasePackage->getPlanInfo->expiry_time),
                ]);
            }
        }elseif ($data->purchasePackage->getPlanInfo->expiry_time_type == 'Year' || $data->purchasePackage->getPlanInfo->expiry_time_type == 'Years'){
            if ($currentDate > $expireDate){
                PurchasePackage::findOrFail($data->purchasePackage->id)->update([
                    'expire_date' => Carbon::now()->addDays($data->purchasePackage->getPlanInfo->expiry_time),
                ]);
            }else{
                PurchasePackage::findOrFail($data->purchasePackage->id)->update([
                    'expire_date' =>  Carbon::parse($expireDate)->addDays($data->purchasePackage->getPlanInfo->expiry_time),
                ]);
            }
        }


        $this->validate($request, [
            'id' => 'required',
            'status' => ['required', Rule::in(['1', '3'])],
        ]);

        $basic = (object)config('basic');

        $req = Purify::clean($request->all());

        if ($request->status == '1') {
            $data->status = 1;
            $data->feedback = @$req['feedback'];
            $data->update();

            $user = $data->user;

            if ($data->purchasePackage->type == 'Purchase'){
                $type = "Buy " .  optional($data->purchasePackage->getPlanInfo->details)->title;
            }else{
                $type = "Renew " .  optional($data->purchasePackage->getPlanInfo->details)->title;
            }

            $remarks = $data->gateway->name;
            BasicService::makeTransaction($user, getAmount($data->amount), getAmount($data->charge),  '+', $data->transaction, $remarks, $id, $type);


            $this->sendMailSms($user, 'PAYMENT_APPROVED', [
                'package' => optional($data->purchasePackage->getPlanInfo->details)->title,
                'gateway_name' => $data->gateway->name,
                'amount' => getAmount($data->amount),
                'charge' => getAmount($data->charge),
                'currency' => $basic->currency,
                'transaction' => $data->transaction,
                'feedback' => $data->feedback,
            ]);

            if ($data->purchasePackage->type != 'Renew'){
                $msg = [
                    'plan' => "Your " . '`' . $planName .'`' . "payment has been approved",
                ];
                $action = [
                    "link" => route('user.myPackages'),
                    "icon" => "fas fa-money-bill-alt text-white"
                ];
                $this->userPushNotification($user, 'PAYMENT_APPROVED', $msg, $action);
            }else{
                $msg = [
                    'plan' => "Your " . '`' . $planName .'`' . "renew payment has been completed",
                ];
                $action = [
                    "link" => route('user.myPackages'),
                    "icon" => "fas fa-money-bill-alt text-white"
                ];
                $this->userPushNotification($user, 'PACKAGE_RENEW_COMPLETED', $msg, $action);
            }

            $data->purchasePackage->status = 1;
            $data->purchasePackage->update();

            session()->flash('success', __('Approved Successfully'));
            return back();

        } elseif ($request->status == '3') {
            $data->status = 3;
            $data->feedback = $request->feedback;
            $data->update();
            $user = $data->user;

            $this->sendMailSms($user, $type = 'DEPOSIT_REJECTED', [
                'package' => optional($data->purchasePackage->getPlanInfo->details)->title,
                'gateway_name' => $data->gateway->name,
                'amount' => getAmount($data->amount),
                'currency' => $basic->currency,
                'transaction' => $data->transaction,
                'feedback' => $data->feedback,
            ]);

            $msg = [
                'plan' => "Your " . '`' . $planName .'`' . "payment has been rejected",
            ];
            $action = [
                "link" => route('user.myPackages'),
                "icon" => "fas fa-money-bill-alt text-white"
            ];

            $this->userPushNotification($user, 'PAYMENT_REJECTED', $msg, $action);

            session()->flash('success', __('Rejected Successfully'));
            return back();
        }
    }
}
