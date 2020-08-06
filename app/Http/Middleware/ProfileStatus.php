<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ProfileStatus
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
        if (Auth::user()->profile->status == 'inactive') {
            Auth::logout();
            return redirect()->route('login.index')->with('error', 'Your account is suspended. Call on 0317 7236914.');

        } else {
            return $next($request);
        }
    }
}
