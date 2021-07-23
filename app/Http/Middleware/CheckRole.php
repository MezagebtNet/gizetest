<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        // $user = User::find(auth()->user()->id);

        // if ($role == 'super_admin' && !$user->roles()->get()->contains(1)) {
        //     abort(403);
        // }

        // if ($role == 'admin' && !$user->roles()->get()->contains(2)) {
        //     abort(403);
        // }

        // if ($role == 'user' && !$user->roles()->get()->contains(3)) {
        //     abort(403);
        // }

        return $next($request);
    }
}
