<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/admin/dashboard';

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {

        $data['title'] = "Admin Login";
        return view('admin.auth.login', $data);
    }

    public function login(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            $this->username() => 'required',
            'password' => 'required',
        ]);
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if(auth()->guard('admin')->attempt(array($fieldType => $input['username'], 'password' => $input['password']))){
            return $this->sendLoginResponse($request);
        }else{
            return redirect()->route('admin.login')
                ->with('error',__('Email-Address And Password Are Wrong.'));
        }
    }

    public function username()
    {
        $login = request()->input('username');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$field => $login]);
        return $field;
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }


    public function logout(Request $request)
    {
        $this->guard('guard')->logout();
        $request->session()->invalidate();
        return $this->loggedOut($request) ?: redirect()->route('admin.login');
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard('admin')->user())) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->intended($this->redirectPath());
    }

    protected function authenticated(Request $request, $user)
    {
        if($user->status == 0){
            $this->guard('guard')->logout();
            return redirect()->route('admin.login')->with('error', __('You are banned from this application. Please contact with system Administrator.'));
        }
        $user->last_login = Carbon::now();
        $user->save();


        return redirect()->intended(route('admin.dashboard'));
    }
}
