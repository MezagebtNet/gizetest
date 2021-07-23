<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
// $user = User::find(auth()->user()->id);
// // dd($user->roles()->get()->contains(1));
// if(!$user->roles()->get()->contains(2)) {
//     abort(403);
// }

        return $next($request);
    }
}
