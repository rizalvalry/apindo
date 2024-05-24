<?php

namespace App\Http\Controllers\User;

use App\Helper\GoogleAuthenticator;
use App\Http\Controllers\Controller;
use App\Models\KYC;
use App\Models\Listing;
use App\Models\UserSocial;
use App\Models\Viewer;
use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Http\Request;
use App\Http\Traits\Notify;
use App\Http\Traits\Upload;
use App\Models\IdentifyForm;
use App\Models\Language;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Stevebauman\Purify\Facades\Purify;

class ProfileController extends Controller
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

    public function profile(Request $request)
    {
        $validator = Validator::make($request->all(), []);
        $data['user'] = $this->user;
        $data['all_viewers_count'] = Viewer::whereUser_id($data['user']->id)->count();
        $data['user_information'] = User::with(['follower.get_follwer_user', 'following.get_following_user'])->findOrFail($data['user']->id);

        $data['social_links'] = UserSocial::where('user_id', $data['user']->id)->get();
        $data['listing_infos'] = Listing::where('user_id', $data['user']->id)->get();
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

    public function profileUpdate(Request $request, $id)
    {
        $request->validate([
            'firstname' => 'required',
            'email' => 'required',
        ]);

        $user = $this->user;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->username = $request->username;
        $user->website = $request->website;
        $user->address = $request->address;
        $user->bio = $request->bio;
        $user->save();

        if ($request->social_icon) {
            UserSocial::where('user_id', $user->id)->delete();
            foreach ($request->social_icon as $key => $value) {
                UserSocial::create([
                    'user_id' => $user->id,
                    'social_icon' => $request->social_icon[$key],
                    'social_url' => $request->social_url[$key],
                    'updated_at' => Carbon::now(),
                ]);
            }
        }

        return back()->with('success', __('Updated Successfully.'));

    }


    public function profileImageUpdate(Request $request)
    {

        $allowedExtensions = array('jpg', 'png', 'jpeg');
        $image = $request->profile_image;
        $validator =  Validator::make($request->all(),[
            'profile_image' => [
                'required',
                'max:4096',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                function ($fail) use ($image, $allowedExtensions) {
                    $ext = strtolower($image->getClientOriginalExtension());
                    if (($image->getSize() / 1000000) > 2) {
                        throw ValidationException::withMessages(['profile_image' => 'Images MAX  2MB ALLOW!']);
                    }
                    if (!in_array($ext, $allowedExtensions)) {
                        throw ValidationException::withMessages(['profile_image' => 'Only png, jpg, jpeg images are allowed']);
                    }
                }
            ]
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->messages()],422);
        }
        $user = $this->user;

        if ($request->hasFile('profile_image')) {
            $image = $this->fileUpload($request->profile_image, config('location.user.path'), $user->driver, null, $user->image);
            if ($image) {
                $user->image = $image['path'];
                $user->driver = $image['driver'];
            }
            $user->save();
        }

        $src = getFile($user->driver, $user->image);

        return response()->json(['src' => $src]);
    }


    public function coverPhotoUpdate(Request $request)
    {

        $allowedExtensions = array('jpg', 'png', 'jpeg');
        $image = $request->user_cover_photo;

        $validator =  Validator::make($request->all(),[
            'user_cover_photo' => [
                'required',
                'max:4096',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                function ($fail) use ($image, $allowedExtensions) {
                    $ext = strtolower($image->getClientOriginalExtension());
                    if (($image->getSize() / 1000000) > 2) {
                        throw ValidationException::withMessages(['user_cover_photo' => 'Images MAX  2MB ALLOW!']);
                    }
                    if (!in_array($ext, $allowedExtensions)) {
                        throw ValidationException::withMessages(['user_cover_photo' => 'Only png, jpg, jpeg images are allowed']);
                    }
                }
            ]
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->messages()],422);
        }
        $user = $this->user;

        if ($request->hasFile('user_cover_photo')) {
            $image = $this->fileUpload($request->user_cover_photo, config('location.user.path'), $user->cover_driver, null, $user->cover_photo);
            if ($image) {
                $user->cover_photo = $image['path'];
                $user->cover_driver = $image['driver'];
            }
            $user->save();
        }

        $src = getFile($user->driver, $user->cover_photo);

        return response()->json(['src' => $src]);
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
            'firstname.required' => 'First Name field is required',
            'lastname.required' => 'Last Name field is required',
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
        $user->email = $req['email'];
        $user->phone = $req['phone'];
        $user->website = $req['website'];
        $user->address = $req['address'];
        $user->bio = $req['bio'];
        $user->save();

        if ($req['social_icon']) {
            UserSocial::where('user_id', $user->id)->delete();
            foreach ($request->social_icon as $key => $value) {
                UserSocial::create([
                    'user_id' => $user->id,
                    'social_icon' => $request->social_icon[$key],
                    'social_url' => $request->social_url[$key],
                    'updated_at' => Carbon::now(),
                ]);
            }
        }

        $msg = [
            'name' => $user->fullname,
        ];

        $adminAction = [
            "link" => route('admin.user-edit', $user->id),
            "icon" => "fas fa-user text-white"
        ];
        $userAction = [
            "link" => route('user.profile'),
            "icon" => "fas fa-user text-white"
        ];

        $this->adminPushNotification('ADMIN_NOTIFY_USER_PROFILE_INFORMATION_UPDATE', $msg, $adminAction);
        $this->userPushNotification($user, 'USER_NOTIFY_HIS_PROFILE_INFORMATION_UPDATE', $msg, $userAction);

        return back()->with('success', 'Updated Successfully.');
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

                $msg = [
                    'name' => $user->fullname,
                ];

                $adminAction = [
                    "link" => route('admin.user-edit', $user->id),
                    "icon" => "fas fa-user text-white"
                ];
                $userAction = [
                    "link" => route('user.profile'),
                    "icon" => "fas fa-user text-white"
                ];

                $this->adminPushNotification('ADMIN_NOTIFY_USER_PROFILE_PASSWORD_UPDATE', $msg, $adminAction);
                $this->userPushNotification($user, 'USER_NOTIFY_HIS_PROFILE_PASSWORD_UPDATE', $msg, $userAction);


                return back()->with('success', 'Password Changes successfully.');
            } else {
                throw new \Exception('Current password did not match');
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
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


        $path = config('location.kyc.path');
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

            $msg = [
                'name' => $user->fullname,
            ];

            $adminAction = [
                "link" => route('admin.kyc.users.pending'),
                "icon" => "fas fa-user text-white"
            ];
            $userAction = [
                "link" => route('user.profile'),
                "icon" => "fas fa-user text-white"
            ];

            $this->adminPushNotification('ADMIN_NOTIFY_USER_KYC_REQUEST', $msg, $adminAction);
            $this->userPushNotification($user, 'USER_NOTIFY_HIS_KYC_REQUEST_SEND', $msg, $userAction);

            $currentDate = dateTime(\Carbon\Carbon::now());
            $this->sendMailSms($user, $type = 'USER_MAIL_HIS_KYC_REQUEST_SEND', [
                'name' => $user->fullname,
                'date' => $currentDate,
            ]);

            $this->mailToAdmin($type = 'ADMIN_MAIL_USER_KYC_REQUEST', [
                'name' => $user->fullname,
                'date' => $currentDate,
            ]);

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

            $msg = [
                'name' => $user->fullname,
            ];

            $adminAction = [
                "link" => route('admin.kyc.users.pending'),
                "icon" => "fas fa-user text-white"
            ];
            $userAction = [
                "link" => route('user.profile'),
                "icon" => "fas fa-user text-white"
            ];

            $this->adminPushNotification('ADMIN_NOTIFY_USER_ADDRESS_VERIFICATION_REQUEST', $msg, $adminAction);
            $this->userPushNotification($user, 'USER_NOTIFY_ADDRESS_VERIFICATION_REQUEST_SEND', $msg, $userAction);

            $currentDate = dateTime(Carbon::now());
            $this->sendMailSms($user, $type = 'USER_MAIL_ADDRESS_VERIFICATION_REQUEST_SEND', [
                'name' => $user->fullname,
                'date' => $currentDate,
            ]);

            $this->mailToAdmin($type = 'ADMIN_MAIL_USER_ADDRESS_VERIFICATION_REQUEST', [
                'name' => $user->fullname,
                'date' => $currentDate,
            ]);

            return redirect()->route('user.profile')->withErrors($validator)->with('success', 'Your request has been submitted.');

        } catch (\Exception $e) {
            $validator->errors()->add('addressVerification', '1');
            return redirect()->route('user.profile')->with('error', $e->getMessage())->withErrors($validator);
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
            return back()->with('success', 'Google Authenticator Has Been Enabled.');
        } else {
            return back()->with('error', 'Wrong Verification Code.');
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

            return back()->with('success', 'Google Authenticator Has Been Disabled.');
        } else {
            return back()->with('error', 'Wrong Verification Code.');
        }
    }

}
