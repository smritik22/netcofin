<?php

namespace App\Http\Middleware;

use Closure;
use App\Mainusers;
use Illuminate\Support\Facades\View;

class GetDomain
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
        $domain = $request->getHost();
        $businessOwner = Mainusers::where('domain', $domain)->firstOrFail();
        echo '<pre>';
        print_r($businessOwner);
        exit;

        // Append domain and businessOwner to the Request object
        // for easy retrieval in the application.
        $request->merge([
            'domain' => $domain,
            'businessOwner' => $businessOwner
        ]);

        // Share tentant data with your views for easier
        // customization across the board
        View::share('businessOwnerColor', $businessOwner->color);
        View::share('businessOwnerName', $businessOwner->name);

        return $next($request);
    }
}