<?php

namespace App\Http\Controllers\Auth;

use App\Http\Traits\Notify;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    use Notify;

    use RegistersUsers;

    protected $redirectTo = '/user/dashboard';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        if (config('basic.registration') == 0) {
            return redirect('/')->with('warning', __('Registration Has Been Disabled.'));
        }

        $info = json_decode(json_encode(getIpInfo()), true);
        $country_code  = null;
        if(!empty($info['code'])){
        $country_code = @$info['code'][0];
        }
        $countries = config('country');

        return view(template().'auth.register',compact('country_code','countries'));
    }

    public function sponsor($sponsor)
    {
        if (config('basic.registration') == 0) {
            return redirect('/')->with('warning', __('Registration Has Been Disabled.'));
        }

        session()->put('sponsor', $sponsor);
        $info = json_decode(json_encode(getIpInfo()), true);
        $country_code  = null;
        if(!empty($info['code'])){
            $country_code = @$info['code'][0];
        }
        $countries = config('country');

        return view(template().'auth.register', compact('sponsor', 'countries','country_code'));

    }

    protected function validator(array $data)
    {
        if (config('basic.strong_password') == 0) {
            $rules['password'] = ['required', 'min:6', 'confirmed'];
        } else {
            $rules['password'] = ["required", 'confirmed',
                Password::min(6)->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()];
        }

        if (basicControl()->reCaptcha_status_registration) {
            $rules['g-recaptcha-response'] = ['sometimes', 'required','captcha'];
        }

        $rules['firstname'] = ['required', 'string', 'max:91'];
        $rules['lastname'] = ['required', 'string', 'max:91'];
        $rules['username'] = ['required', 'alpha_dash', 'min:5', 'unique:users,username'];
        $rules['email'] = ['required', 'string', 'email', 'max:255', 'unique:users,email'];
        $rules['country_code'] = ['max:5'];
        $rules['phone_code'] = ['required'];
        $rules['phone'] = ['required'];
        return Validator::make($data, $rules, [
            'firstname.required' => __('First Name Field is required'),
            'lastname.required' => __('Last Name Field is required')
        ]);

    }

    protected function create(array $data)
    {
        $basic = (object) config('basic');

        $sponsor = session()->get('sponsor');
        if ($sponsor != null) {
            $sponsorId = User::where('username', $sponsor)->first();
        } else {
            $sponsorId = null;
        }


        return  User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'username' => $data['username'],
            'email' => $data['email'],
            'referral_id' => ($sponsorId != null) ? $sponsorId->id : null,
            'country_code' => $data['country_code'],
            'phone_code' => $data['phone_code'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'email_verification' => ($basic->email_verification) ? 0 : 1,
            'sms_verification' => ($basic->sms_verification) ? 0 : 1,
        ]);
    }

    public function register(Request $request)
    {

        $this->validator($request->all())->validate();

        $user = $this->create($request->all());
        $msg = [
            'username' => $user->username,
        ];
        $action = [
            "link" => route('admin.user-edit',$user->id),
            "icon" => "fas fa-user text-white"
        ];

        $this->adminPushNotification('ADDED_USER', $msg, $action);

        $this->guard()->login($user);


        session()->forget('sponsor');

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        if($request->ajax()) {
            return route('user.home');
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }

    protected function registered(Request $request, $user)
    {
        $user->last_login = Carbon::now();
        $user->two_fa_verify = ($user->two_fa == 1) ? 0 : 1;
        $user->save();

    }

    protected function guard()
    {
        return Auth::guard();
    }

}
