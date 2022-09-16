<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Session;

class LogoutUserStatus
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
        if (Auth::User()->status == '0') {
            //echo 'hello';exit;
            Auth::logout();
            Session::flush();
            return redirect('/admin/login');
        }else{
            return $next($request);    
        }
        
    }
}
