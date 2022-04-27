<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ResetPassword;
use App\Http\Requests\User\StoreUser;
use App\Http\Requests\User\UpdateUser;
use App\Models\Role;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()
            ->with('info')
            ->where('id', '!=', 1)
            ->orderby('id', 'desc')
            ->paginate(config('constants.limit_page'));
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        $wards = Ward::all();
        $roles = Role::all();
        return view('admin.user.create', compact('wards', 'roles'));
    }

    public function store(StoreUser $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        try {
            $new_user = DB::transaction(function() use ($data) {
                $new_user = User::create([
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
                    'role_id' => $data['role_id']
                ]);
                UserInfo::create([
                    'name' => $data['name'],
                    'phone_number' => $data['phone_number'],
                    'dob' => $data['dob'],
                    'card_id' => $data['card_id'],
                    'ward_id' => $data['ward_id'],
                    'user_id' => $new_user->id
                ]);
                return $new_user;
            });
            return redirect(route('admin.user.edit', ['id' => $new_user->id]))
                ->with('alert-success', trans('alert.create.success'));
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            dd($th->getMessage());
        }
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->where('id', '!=', 1)->firstOrFail();
        $wards = Ward::all();
        $roles = Role::all();
        return view('admin.user.edit', compact('user', 'wards', 'roles'));
    }

    public function update(UpdateUser $request, $id)
    {
        $data = $request->validated();
        DB::transaction(function() use ($data, $id) {
            $user = User::findOrFail($id);
            $user->update([
                'role_id' => $data['role_id']
            ]);
            $user->info()->update([
                'name' => $data['name'],
                'phone_number' => $data['phone_number'],
                'dob' => $data['dob'],
                'card_id' => $data['card_id'],
                'ward_id' => $data['ward_id'],
            ]);
        });
        return back()->with('alert-success', trans('alert.update.success'));
    }

    function showFormResetPassword($id)
    {
        return view('admin.user.reset_password', compact('id'));
    }

    function resetPassword(ResetPassword $request, $id)
    {
        $data = $request->only('password');
        $data['password'] = bcrypt($data['password']);
        User::findOrFail($id)->update($data);
        return redirect(route('admin.user.edit', ['id' => $id]))
            ->with('alert-success', trans('passwords.reset'));
    }

    public function handleAccount($id)
    {
        $user = User::findOrFail($id);

        DB::enableQueryLog();
        $user->update([
            'is_actived' => !$user->is_actived
        ]);
        info(DB::getQueryLog());
        return back()->with('alert-success', trans('alert.update.success'));
    }
}
