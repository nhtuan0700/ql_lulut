<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateInfo;
use App\Http\Requests\User\UpdatePassword;
use App\Models\Company;
use App\Models\UserInfo;
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
        $dataInfo = $request->only('name', 'address', 'card_id', 'phone_number', 'dob');
        $userInfo = UserInfo::where('user_id', auth()->id())->first();
        $userInfo->update($dataInfo);
        if ($request->type == 2) {
            Company::updateOrCreate(['user_id' => auth()->id()], [
                'name' => $request->company_name,
                'address' => $request->company_address,
            ]);
        } else {
            Company::where('user_id', auth()->id())->delete();
        }
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
