<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(LoginRequest $request)
    {
        $crendentials = $request->only('email', 'password');
        $bool = $request->has('remember') ? true : false;
        if (Auth::attempt($crendentials, $bool)) {
            return redirect(route('admin.index'));
        }
        return back()->with('alert-fail', trans('auth.failed'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('admin.login'));
    }
}
