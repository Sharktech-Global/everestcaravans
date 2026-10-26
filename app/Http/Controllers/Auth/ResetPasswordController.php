<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    public function broker()
    {
        return app('auth.password')->broker('admins');
    }

    protected function guard()
    {
        return auth()->guard('admin');
    }

    protected function redirectTo()
    {
        return route('admin.home');
    }
}
