<?php

namespace App\Http\Controllers\BusinessOwner;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Validator;
use Session;
use DB;
use Mail;
use Cookie;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Setting;

class HomeController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    // protected $redirectTo = 'admin/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
    }

     protected function home(Request $request)
    {
    //    echo "hdfg";  exit;
        return view("businessOwner.dashboard.contentManagement.home.list");
    }
    protected function aboutUs(Request $request)
    {
        return view("businessOwner.dashboard.contentManagement.aboutUs.list");
    }

    protected function contact(Request $request)
    {
        return view("businessOwner.dashboard.contentManagement.contact.list");
    }

    protected function order(Request $request)
    {
        return view("businessOwner.dashboard.order.list");
    }

    protected function book(Request $request)
    {
        return view("businessOwner.dashboard.booktable");
    }
}
