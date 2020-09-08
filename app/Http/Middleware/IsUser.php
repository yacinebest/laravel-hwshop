<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class IsUser
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
        $role_user = User::whereType('USER')->first();
        if (Auth::user() &&  Auth::user()->role_id == $role_user->id) {
            return $next($request);
        }

        return redirect('/');
    }
}
