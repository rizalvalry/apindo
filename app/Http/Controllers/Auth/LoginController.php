<?php

namespace App\Http\Controllers\Auth;

use App\Template;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/user/dashboard';

    public function __construct()
    {
        $this->theme = template();
        $this->middleware('guest')->except('logout');
    }


    public function loginModal(Request $request)
    {
        $this->validateLogin($request);
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if($this->guard()->validate($this->credentials($request))){
            if(Auth::attempt([$this->username() => $request->username, 'password' =>  $request->password, 'status' =>  1])){
                $user = Auth::user();
                $user->last_login = Carbon::now();
                $user->save();
                $request->session()->regenerate();
                return route('user.home');
            }else{
                return response()->json('You are banned from this application. Please contact with system Adminstrator.',401);
            }
        }
        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }



    public function login(Request $request)
    {
        $this->validateLogin($request);
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        if ($this->guard()->validate($this->credentials($request))) {
            if (Auth::attempt([$this->username() => $request->username, 'password' => $request->password,'status'=>1])) {
                return $this->sendLoginResponse($request)->with('success', 'You are logged in');
            } else {
                return back()->with('error', __('You are banned from this application. Please contact with system Administrator.'));
            }
        }
        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }

    protected function validateLogin(Request $request)
    {
        $validateData = [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ];

        if (basicControl()->reCaptcha_status_login) {
            $validateData['g-recaptcha-response'] = 'sometimes|required|captcha';
        }

        $request->validate($validateData, [
            'g-recaptcha-response.required' => 'The reCAPTCHA field is required.',
        ]);
    }

    public function username()
    {
        $login = request()->input('username');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$field => $login]);
        return $field;
    }

    public function showLoginForm()
    {
        return view($this->theme . 'auth.login');
    }

    public function showAdminLoginForm()
    {
        return view('auth.login', ['url' => 'admin']);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        return $this->loggedOut($request) ?: redirect('/login')->with('success', 'You are Logged out');
    }

    protected function authenticated(Request $request, $user)
    {
        $user->last_login = Carbon::now();
        $user->two_fa_verify = ($user->two_fa == 1) ? 0 : 1;
        $user->save();
    }

    protected function guard()
    {
        return \Illuminate\Support\Facades\Auth::guard();
    }

}
