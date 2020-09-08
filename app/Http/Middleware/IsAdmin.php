<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin
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
        // return $next($request);
        $role_admin = Role::whereType('ADMIN')->first();
        if (Auth::user() &&  Auth::user()->role_id == $role_admin->id) {
            return $next($request);
        }

        return redirect('/');
    }
}
