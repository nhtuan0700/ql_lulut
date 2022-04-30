<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('client.auth.login');
    }

    public function login(LoginRequest $request)
    {
        $crendentials = $request->only('email', 'password');
        $bool = $request->has('remember') ? true : false;
        $crendentials['role_id'] = Role::SUPPORTER;
        if (Auth::attempt($crendentials, $bool)) {
            return redirect(route('index'));
        }
        return back()->with('alert-fail', trans('auth.failed'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('login'));
    }
}
