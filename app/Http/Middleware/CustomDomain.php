<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Auth;

class CustomDomain
{
    /**
     * Get the path the user should be redirected to when they are not CustomDomaind.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check())
        {
            if (auth()->guard('web')->check()) {
                return redirect()->route('adminHome');
            }
        }
        return $next($request);

    }
}
