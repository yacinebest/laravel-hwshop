<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Support\Facades\Auth;

class AccessManagementAuth
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
        $role_admin = Role::whereType('ADMIN')->first();
        if(!Auth::check())
            return $next($request);
        else if (  Auth::user() &&  Auth::user()->role_id == $role_admin->id)
            return $next($request);


        return redirect('/');
    }
}
