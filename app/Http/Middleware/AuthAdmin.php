<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Support\Facades\Auth;

class AuthAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->role->id != Role::SUPPORTER){
            return $next($request);
        }
        return redirect(route('admin.login'))->with('alert-fail', 'Không thể truy cập hệ thống');
    }
}
