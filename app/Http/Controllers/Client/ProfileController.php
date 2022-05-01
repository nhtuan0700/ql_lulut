<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateInfo;
use App\Http\Requests\User\UpdatePassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function info()
    {
        $user = auth()->user();
        return view('client.profile.info', compact('user'));
    }

    public function updateInfo(UpdateInfo $request)
    {
        $data = $request->validated();
        auth()->user()->info->update($data);
        return back()->with('alert-success', trans('alert.update.success'));
    }

    public function showFormUpdatePassword()
    {
        return view('client.profile.password');
    }

    public function updatePassword(UpdatePassword $request)
    {
        if (!Hash::check($request->password, auth()->user()->password)) {
            return back()
                ->withErrors(['password' => trans('auth.password')]);
        }
        $data['password'] = Hash::make($request->new_password);
        auth()->user()->update($data);
        return back()->with('alert-success', trans('alert.update.success'));
    }
}
