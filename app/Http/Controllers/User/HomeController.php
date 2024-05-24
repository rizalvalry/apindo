<?php

namespace App\Http\Controllers\User;

use App\Helper\GoogleAuthenticator;
use App\Http\Controllers\Controller;
use App\Http\Traits\Notify;
use App\Http\Traits\Upload;
use App\Models\Fund;
use App\Models\Gateway;
use App\Models\IdentifyForm;
use App\Models\KYC;
use App\Models\Language;
use App\Models\Listing;
use App\Models\PayoutLog;
use App\Models\PayoutMethod;
use App\Models\Product;
use App\Models\ProductQuery;
use App\Models\PurchasePackage;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Viewer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Stevebauman\Purify\Facades\Purify;
use Facades\App\Services\BasicService;

use hisorange\BrowserDetect\Parser as Browser;

class HomeController extends Controller
{
    use Upload, Notify;

    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            return $next($request);
        });
        $this->theme = template();
    }

    public function index(Request $request)
    {
        $userID = $this->user->id;
        $data['all_viewers_count'] = Viewer::whereUser_id($this->user->id)->count();
        $data['user_information'] = User::with(['follower.get_follwer_user', 'following.get_following_user'])->findOrFail($this->user->id);

        $data['all_listing_addresses'] = Listing::where('user_id', $this->user->id)->distinct()->pluck('address');

        $data['listings'] = collect(Listing::selectRaw("COUNT(CASE WHEN user_id = $userID   THEN id END) AS listing_infos")
            ->selectRaw("COUNT(CASE WHEN user_id = $userID  AND status = 1  THEN id END) AS activeListing")
            ->selectRaw("COUNT(CASE WHEN user_id = $userID  AND status = 0  THEN id END) AS pendingListing")
            ->get()->makeHidden(['avgRating'])->toArray())->collapse();




        $data['userPurchasePackage'] = PurchasePackage::with(['get_package', 'getPlanInfo'])->where('user_id', $this->user->id)->take(3)->latest()->get();
        $data['pendingPackage'] = PurchasePackage::where('user_id', $this->user->id)->where('status', 0)->count();
        $data['activePackage'] = PurchasePackage::where('user_id', $this->user->id)->where('status', 1)->count();


        $data['totalProduct'] = Product::where('user_id', $this->user->id)->count();
        $data['productUnseenQuires']  = ProductQuery::where('user_id', $this->user->id)->where('customer_enquiry', 0)->count();

        $search = $request->all();
        $data['user_listings'] = Listing::with(['get_package.get_package'])->latest()
            ->when(isset($search['listing_search_name']), function ($query) use ($search) {
                return $query->where('title', 'LIKE', "%{$search['listing_search_name']}%")->orWhere('address', 'LIKE', "%{$search['listing_search_name']}%")
                    ->orWhereHas('get_package.get_package', function ($q2) use ($search) {
                        $q2->where('title', 'LIKE', "%{$search['listing_search_name']}%");
                    });
            })
            ->when(isset($search['listing_location_name']), function ($query2) use ($search) {
                return $query2->where('address', 'LIKE', "%{$search['listing_location_name']}%");
            })
            ->where('user_id', $this->user->id)
            ->limit(5)->get();
        $packages = PurchasePackage::select('expire_date')->where('user_id', auth()->id())->whereDate('expire_date', '>=', today())->whereNotNull('expire_date')->orderBy('expire_date','asc')->first();
        $data['handover'] = $packages ? Carbon::parse($packages->expire_date)->format('Y-m-d') : today()->format('Y-m-d');

        return view($this->theme . 'user.dashboard', $data);
    }


    public function transaction()
    {
        $data['transactions'] = $this->user->transaction()->orderBy('id', 'DESC')->paginate(config('basic.paginate'));
        return view($this->theme . 'user.transaction.index', $data);
    }

    public function transactionSearch(Request $request)
    {
        $search = $request->all();
        $dateSearch = Carbon::parse($request->datetrx);
        $date = preg_match("/^[0-9]{2,4}\-[0-9]{1,2}\-[0-9]{1,2}$/", $dateSearch);

        $transaction = Transaction::where('user_id', $this->user->id)
            ->when(@$search['transaction_id'], function ($query) use ($search) {
                return $query->where('trx_id', 'LIKE', "%{$search['transaction_id']}%");
            })
            ->when(@$search['remark'], function ($query) use ($search) {
                return $query->where('type', 'LIKE', "%{$search['remark']}%");
            })
            ->when(@$search['datetrx'], function ($query) use ($dateSearch) {
                return $query->whereDate("created_at", $dateSearch);
            })
            ->paginate(config('basic.paginate'));
        $data['transactions'] = $transaction->appends($search);
        return view($this->theme . 'user.transaction.index', $data);
    }

    public function fundHistory()
    {
        $funds = Fund::where('user_id', $this->user->id)->where('status', '!=', 0)->orderBy('id', 'DESC')->with('gateway')->paginate(config('basic.paginate'));
        return view($this->theme . 'user.transaction.fundHistory', compact('funds'));
    }

    public function fundHistorySearch(Request $request)
    {
        $search = $request->all();

        $dateSearch = $request->date_time;
        $date = preg_match("/^[0-9]{2,4}\-[0-9]{1,2}\-[0-9]{1,2}$/", $dateSearch);

        $funds = Fund::orderBy('id', 'DESC')->where('user_id', $this->user->id)->where('status', '!=', 0)
            ->when(isset($search['name']), function ($query) use ($search) {
                return $query->where('transaction', 'LIKE', $search['name']);
            })
            ->when($date == 1, function ($query) use ($dateSearch) {
                return $query->whereDate("created_at", $dateSearch);
            })
            ->when(isset($search['status']), function ($query) use ($search) {
                return $query->where('status', $search['status']);
            })
            ->with('gateway')
            ->paginate(config('basic.paginate'));
        $funds->appends($search);

        return view($this->theme . 'user.transaction.fundHistory', compact('funds'));

    }


    public function addFund()
    {
        if (session()->get('plan_id') != null) {
            return redirect(route('user.payment'));
        }

        $data['totalPayment'] = null;
        $data['gateways'] = Gateway::where('status', 1)->orderBy('sort_by', 'ASC')->get();

        return view($this->theme . 'user.addFund', $data);
    }


    public function profile(Request $request)
    {
        $validator = Validator::make($request->all(), []);
        $data['user'] = $this->user;

        $data['languages'] = Language::all();
        $data['identityFormList'] = IdentifyForm::where('status', 1)->get();
        if ($request->has('identity_type')) {
            $validator->errors()->add('identity', '1');
            $data['identity_type'] = $request->identity_type;
            $data['identityForm'] = IdentifyForm::where('slug', trim($request->identity_type))->where('status', 1)->firstOrFail();
            return view($this->theme . 'user.profile.myprofile', $data)->withErrors($validator);
        }

        return view($this->theme . 'user.profile.myprofile', $data);
    }


    public function updateProfile(Request $request)
    {
        $allowedExtensions = array('jpg', 'png', 'jpeg');

        $image = $request->image;


        $this->validate($request, [
            'image' => [
                'required',
                'max:4096',
                function ($fail) use ($image, $allowedExtensions) {
                    $ext = strtolower($image->getClientOriginalExtension());
                    if (($image->getSize() / 1000000) > 2) {
                        throw ValidationException::withMessages(['image' => 'Images MAX  2MB ALLOW!']);
                    }
                    if (!in_array($ext, $allowedExtensions)) {
                        throw ValidationException::withMessages(['image' => 'Only png, jpg, jpeg images are allowed']);
                    }

                }
            ]
        ]);

        $user = $this->user;
        if ($request->hasFile('image')) {
            $path = config('location.user.path');
            try {
                $image = $this->fileUpload($image, $path, $user->driver, null);

                if ($image) {
                    $user->image = $image['path'];
                    $user->driver = $image['driver'];
                }
            } catch (\Exception $exp) {
                return back()->with('error', 'Could not upload your ' . $image)->withInput();
            }
        }
        $user->save();
        return back()->with('success', __('Updated Successfully.'));
    }


    public function updateInformation(Request $request)
    {

        $languages = Language::all()->map(function ($item) {
            return $item->id;
        });

        $req = Purify::clean($request->all());
        $user = $this->user;
        $rules = [
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => "sometimes|required|alpha_dash|min:5|unique:users,username," . $user->id,
            'address' => 'required',
            'language_id' => Rule::in($languages),
        ];
        $message = [
            'firstname.required' => __('First Name field is required'),
            'lastname.required' => __('Last Name field is required'),
        ];

        $validator = Validator::make($req, $rules, $message);
        if ($validator->fails()) {
            $validator->errors()->add('profile', '1');
            return back()->withErrors($validator)->withInput();
        }
        $user->language_id = $req['language_id'];
        $user->firstname = $req['firstname'];
        $user->lastname = $req['lastname'];
        $user->username = $req['username'];
        $user->address = $req['address'];
        $user->save();
        return back()->with('success', __('Updated Successfully.'));
    }

    public function changePassIndex(Request $request)
    {
        $validator = Validator::make($request->all(), []);
        $data['user'] = $this->user;
        $data['languages'] = Language::all();
        return view($this->theme . 'user.setting.password.index', $data);
    }


    public function updatePassword(Request $request)
    {

        $rules = [
            'current_password' => "required",
            'password' => "required|min:5|confirmed",
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $validator->errors()->add('password', '1');
            return back()->withErrors($validator)->withInput();
        }
        $user = $this->user;
        try {
            if (Hash::check($request->current_password, $user->password)) {
                $user->password = bcrypt($request->password);
                $user->save();
                return back()->with('success', __('Password Changes successfully.'));
            } else {
                throw new \Exception(__('Current password did not match'));
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }


    public function twoStepSecurity()
    {
        $basic = (object)config('basic');
        $ga = new GoogleAuthenticator();
        $secret = $ga->createSecret();
        $qrCodeUrl = $ga->getQRCodeGoogleUrl($this->user->username . '@' . $basic->site_title, $secret);
        $previousCode = $this->user->two_fa_code;

        $previousQR = $ga->getQRCodeGoogleUrl($this->user->username . '@' . $basic->site_title, $previousCode);
        return view($this->theme . 'user.twoFA.index', compact('secret', 'qrCodeUrl', 'previousCode', 'previousQR'));
    }

    public function twoStepEnable(Request $request)
    {
        $user = $this->user;
        $this->validate($request, [
            'key' => 'required',
            'code' => 'required',
        ]);
        $ga = new GoogleAuthenticator();
        $secret = $request->key;
        $oneCode = $ga->getCode($secret);

        $userCode = $request->code;
        if ($oneCode == $userCode) {
            $user['two_fa'] = 1;
            $user['two_fa_verify'] = 1;
            $user['two_fa_code'] = $request->key;
            $user->save();
            $browser = new Browser();
            $this->mail($user, 'TWO_STEP_ENABLED', [
                'action' => 'Enabled',
                'code' => $user->two_fa_code,
                'ip' => request()->ip(),
                'browser' => $browser->browserName() . ', ' . $browser->platformName(),
                'time' => date('d M, Y h:i:s A'),
            ]);
            return back()->with('success', __('Google Authenticator Has Been Enabled.'));
        } else {
            return back()->with('error', __('Wrong Verification Code.'));
        }
    }

    public function twoStepDisable(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
        ]);
        $user = $this->user;
        $ga = new GoogleAuthenticator();

        $secret = $user->two_fa_code;
        $oneCode = $ga->getCode($secret);
        $userCode = $request->code;

        if ($oneCode == $userCode) {
            $user['two_fa'] = 0;
            $user['two_fa_verify'] = 1;
            $user['two_fa_code'] = null;
            $user->save();
            $browser = new Browser();
            $this->mail($user, 'TWO_STEP_DISABLED', [
                'action' => 'Disabled',
                'ip' => request()->ip(),
                'browser' => $browser->browserName() . ', ' . $browser->platformName(),
                'time' => date('d M, Y h:i:s A'),
            ]);

            return back()->with('success', __('Google Authenticator Has Been Disabled.'));
        } else {
            return back()->with('error', __('Wrong Verification Code.'));
        }
    }

    public function payoutMoney()
    {
        $data['title'] = "Payout Money";
        $data['gateways'] = PayoutMethod::whereStatus(1)->get();
        return view($this->theme . 'user.payout.money', $data);
    }

    public function payoutMoneyRequest(Request $request)
    {
        $this->validate($request, [
            'gateway' => 'required|integer',
            'amount' => ['required', 'numeric']
        ]);

        $basic = (object)config('basic');
        $method = PayoutMethod::where('id', $request->gateway)->where('status', 1)->firstOrFail();
        $authWallet = $this->user;

        $charge = $method->fixed_charge + ($request->amount * $method->percent_charge / 100);

        $finalAmo = $request->amount + $charge;

        if ($request->amount < $method->minimum_amount) {
            session()->flash('error', 'Minimum payout Amount ' . round($method->minimum_amount, 2) . ' ' . $basic->currency);
            return back();
        }
        if ($request->amount > $method->maximum_amount) {
            session()->flash('error', 'Maximum payout Amount ' . round($method->maximum_amount, 2) . ' ' . $basic->currency);
            return back();
        }

        if (getAmount($finalAmo) > $authWallet['balance']) {
            session()->flash('error', 'Insufficient ' . snake2Title($authWallet['balance']) . ' For Withdraw.');
            return back();
        } else {
            $trx = strRandom();
            $withdraw = new PayoutLog();
            $withdraw->user_id = $authWallet->id;
            $withdraw->method_id = $method->id;
            $withdraw->amount = getAmount($request->amount);
            $withdraw->charge = $charge;
            $withdraw->net_amount = $finalAmo;
            $withdraw->trx_id = $trx;
            $withdraw->status = 0;
            $withdraw->save();
            session()->put('wtrx', $trx);
            return redirect()->route('user.payout.preview');
        }
    }

    public function payoutPreview()
    {
        $withdraw = PayoutLog::latest()->where('trx_id', session()->get('wtrx'))->where('status', 0)->latest()->with('method', 'user')->firstOrFail();
        $title = "Payout Form";

        $remaining = getAmount(auth()->user()->balance - $withdraw->net_amount);
        return view($this->theme . 'user.payout.preview', compact('withdraw', 'title', 'remaining'));
    }


    public function payoutRequestSubmit(Request $request)
    {
        $basic = (object)config('basic');
        $withdraw = PayoutLog::latest()->where('trx_id', session()->get('wtrx'))->where('status', 0)->with('method', 'user')->firstOrFail();
        $rules = [];
        $inputField = [];
        if (optional($withdraw->method)->input_form != null) {
            foreach ($withdraw->method->input_form as $key => $cus) {
                $rules[$key] = [$cus->validation];
                if ($cus->type == 'file') {
                    array_push($rules[$key], 'image');
                    array_push($rules[$key], 'mimes:jpeg,jpg,png');
                    array_push($rules[$key], 'max:2048');
                }
                if ($cus->type == 'text') {
                    array_push($rules[$key], 'max:191');
                }
                if ($cus->type == 'textarea') {
                    array_push($rules[$key], 'max:300');
                }
                $inputField[] = $key;
            }
        }

        $this->validate($request, $rules);
        $user = $this->user;

        if (getAmount($withdraw->net_amount) > $user->balance) {
            session()->flash('error', 'Insufficient balance For Payout.');
            return redirect()->route('user.payout.money');
        } else {
            $collection = collect($request);
            $reqField = [];
            if ($withdraw->method->input_form != null) {
                foreach ($collection as $k => $v) {
                    foreach ($withdraw->method->input_form as $inKey => $inVal) {
                        if ($k != $inKey) {
                            continue;
                        } else {
                            if ($inVal->type == 'file') {
                                if ($request->hasFile($inKey)) {
                                    $image = $request->file($inKey);
                                    $filename = time() . uniqid() . '.jpg';
                                    $location = config('location.withdrawLog.path');
                                    $reqField[$inKey] = [
                                        'field_name' => $filename,
                                        'type' => $inVal->type,
                                    ];
                                    try {
                                        $this->uploadImage($image, $location, $size = null, $old = null, $thumb = null, $filename);

                                    } catch (\Exception $exp) {
                                        return back()->with('error', __('Image could not be uploaded.'));
                                    }

                                }
                            } else {
                                $reqField[$inKey] = $v;
                                $reqField[$inKey] = [
                                    'field_name' => $v,
                                    'type' => $inVal->type,
                                ];
                            }
                        }
                    }
                }
                $withdraw['information'] = $reqField;
            } else {
                $withdraw['information'] = null;
            }

            $withdraw->status = 1;
            $withdraw->save();

            $user['balance'] -= $withdraw->net_amount;
            $user->save();


            $remarks = 'Withdraw Via ' . optional($withdraw->method)->name;
            BasicService::makeTransaction($user, $withdraw->amount, $withdraw->charge, '-', $withdraw->trx_id, $remarks);


            $this->sendMailSms($user, $type = 'PAYOUT_REQUEST', [
                'method_name' => optional($withdraw->method)->name,
                'amount' => getAmount($withdraw->amount),
                'charge' => getAmount($withdraw->charge),
                'currency' => $basic->currency_symbol,
                'trx' => $withdraw->trx_id,
            ]);


            $msg = [
                'username' => $user->username,
                'amount' => getAmount($withdraw->amount),
                'currency' => $basic->currency_symbol,
            ];
            $action = [
                "link" => route('admin.user.withdrawal', $user->id),
                "icon" => "fa fa-money-bill-alt "
            ];
            $this->adminPushNotification('PAYOUT_REQUEST', $msg, $action);

            session()->flash('success', __('Payout request Successfully Submitted. Wait For Confirmation.'));
            return redirect()->route('user.payout.money');
        }
    }


    public function payoutHistory()
    {
        $user = $this->user;
        $data['payoutLog'] = PayoutLog::whereUser_id($user->id)->where('status', '!=', 0)->latest()->with('user', 'method')->paginate(config('basic.paginate'));
        $data['title'] = "Payout Log";
        return view($this->theme . 'user.payout.log', $data);
    }


    public function payoutHistorySearch(Request $request)
    {
        $search = $request->all();

        $dateSearch = $request->date_time;
        $date = preg_match("/^[0-9]{2,4}\-[0-9]{1,2}\-[0-9]{1,2}$/", $dateSearch);

        $payoutLog = PayoutLog::orderBy('id', 'DESC')->where('user_id', $this->user->id)->where('status', '!=', 0)
            ->when(isset($search['name']), function ($query) use ($search) {
                return $query->where('trx_id', 'LIKE', $search['name']);
            })
            ->when($date == 1, function ($query) use ($dateSearch) {
                return $query->whereDate("created_at", $dateSearch);
            })
            ->when(isset($search['status']), function ($query) use ($search) {
                return $query->where('status', $search['status']);
            })
            ->with('user', 'method')->paginate(config('basic.paginate'));
        $payoutLog->appends($search);

        $title = "Payout Log";
        return view($this->theme . 'user.payout.log', compact('title', 'payoutLog'));
    }


    public function verificationSubmit(Request $request)
    {
        $identityFormList = IdentifyForm::where('status', 1)->get();
        $rules['identity_type'] = ["required", Rule::in($identityFormList->pluck('slug')->toArray())];
        $identity_type = $request->identity_type;
        $identityForm = IdentifyForm::where('slug', trim($identity_type))->where('status', 1)->firstOrFail();

        $params = $identityForm->services_form;

        $rules = [];
        $inputField = [];
        $verifyImages = [];

        if ($params != null) {
            foreach ($params as $key => $cus) {
                $rules[$key] = [$cus->validation];
                if ($cus->type == 'file') {
                    array_push($rules[$key], 'image');
                    array_push($rules[$key], 'mimes:jpeg,jpg,png');
                    array_push($rules[$key], 'max:2048');
                    array_push($verifyImages, $key);
                }
                if ($cus->type == 'text') {
                    array_push($rules[$key], 'max:191');
                }
                if ($cus->type == 'textarea') {
                    array_push($rules[$key], 'max:300');
                }
                $inputField[] = $key;
            }
        }

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $validator->errors()->add('identity', '1');

            return back()->withErrors($validator)->withInput();
        }


        $path = config('location.kyc.path') . date('Y') . '/' . date('m') . '/' . date('d');
        $collection = collect($request);

        $reqField = [];
        if ($params != null) {
            foreach ($collection as $k => $v) {
                foreach ($params as $inKey => $inVal) {
                    if ($k != $inKey) {
                        continue;
                    } else {
                        if ($inVal->type == 'file') {
                            if ($request->hasFile($inKey)) {
                                try {
                                    $reqField[$inKey] = [
                                        'field_name' => $this->fileUpload($request[$inKey], $path),
                                        'type' => $inVal->type,
                                    ];
                                } catch (\Exception $exp) {
                                    session()->flash('error', 'Could not upload your ' . $inKey);
                                    return back()->withInput();
                                }
                            }
                        } else {
                            $reqField[$inKey] = $v;
                            $reqField[$inKey] = [
                                'field_name' => $v,
                                'type' => $inVal->type,
                            ];
                        }
                    }
                }
            }
        }

        try {

            DB::beginTransaction();

            $user = $this->user;
            $kyc = new KYC();
            $kyc->user_id = $user->id;
            $kyc->kyc_type = $identityForm->slug;
            $kyc->details = $reqField;
            $kyc->save();

            $user->identity_verify = 1;
            $user->save();

            if (!$kyc) {
                DB::rollBack();
                $validator->errors()->add('identity', '1');
                return back()->withErrors($validator)->withInput()->with('error', "Failed to submit request");
            }
            DB::commit();
            return redirect()->route('user.profile')->withErrors($validator)->with('success', 'KYC request has been submitted.');

        } catch (\Exception $e) {
            return redirect()->route('user.profile')->withErrors($validator)->with('error', $e->getMessage());
        }
    }

    public function addressVerification(Request $request)
    {

        $rules = [];
        $rules['addressProof'] = ['image', 'mimes:jpeg,jpg,png', 'max:2048'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $validator->errors()->add('addressVerification', '1');
            return back()->withErrors($validator)->withInput();
        }

        $path = config('location.kyc.path') . date('Y') . '/' . date('m') . '/' . date('d');

        $reqField = [];
        try {
            if ($request->hasFile('addressProof')) {
                $reqField['addressProof'] = [
                    'field_name' => $this->fileUpload($request['addressProof'], $path),
                    'type' => 'file',
                ];
            } else {
                $validator->errors()->add('addressVerification', '1');

                session()->flash('error', 'Please select a ' . 'address Proof');
                return back()->withInput();
            }
        } catch (\Exception $exp) {
            session()->flash('error', 'Could not upload your ' . 'address Proof');
            return redirect()->route('user.profile')->withInput();
        }

        try {

            DB::beginTransaction();
            $user = $this->user;
            $kyc = new KYC();
            $kyc->user_id = $user->id;
            $kyc->kyc_type = 'address-verification';
            $kyc->details = $reqField;
            $kyc->save();
            $user->address_verify = 1;
            $user->save();

            if (!$kyc) {
                DB::rollBack();
                $validator->errors()->add('addressVerification', '1');
                return redirect()->route('user.profile')->withErrors($validator)->withInput()->with('error', "Failed to submit request");
            }
            DB::commit();
            return redirect()->route('user.profile')->withErrors($validator)->with('success', 'Your request has been submitted.');

        } catch (\Exception $e) {
            $validator->errors()->add('addressVerification', '1');
            return redirect()->route('user.profile')->with('error', $e->getMessage())->withErrors($validator);
        }
    }

    public function calender()
    {
        $packages = PurchasePackage::where('user_id', auth()->id())->whereDate('expire_date', '>=', today())->whereNotNull('expire_date')->get();
        $data = [];

        foreach ($packages as $pacakge) {
            $data[] = [
                'title' => $pacakge->get_package->title,
                'url' => route('user.myPackages', $pacakge->id),
                'start' => $pacakge->expire_date->format('Y-m-d')
            ];
        }
        return response()->json($data);
    }
}
