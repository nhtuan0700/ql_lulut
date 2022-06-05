<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Company;
use App\Models\Role;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    //
    public function showRegisterForm()
    {
        return view('client.auth.register');
    }

    public function register(RegisterRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $newUser = User::create([
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'role_id' => Role::SUPPORTER
                ]);
                UserInfo::create([
                    'name' => $request->name,
                    'user_id' => $newUser->id,
                    'phone_number' => $request->phone_number
                ]);
                if ($request->type == 2) {
                    Company::create([
                        'user_id' => $newUser->id,
                        'name' => $request->company_name, 
                        'address' => $request->company_address 
                    ]);
                }
            });

            return redirect(route('login'))->with('alert-success', trans('alert.register.success'));
        } catch (\Throwable $th) {
            Log::error($th);
            return back()->with('alert-fail', trans('alert.register.fail'));
        }
    }
}
