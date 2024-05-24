<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = 'login';

    public function showResetForm(Request $request, $token = null)
    {

        return view(template().'auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
}
