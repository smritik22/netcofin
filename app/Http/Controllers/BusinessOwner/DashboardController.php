<?php

namespace App\Http\Controllers\BusinessOwner;

use App\Charts\PropertyChart;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Carbon\Carbon;
use Auth;
use Helper;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // exit(Auth::user());
        // $this->middleware('businessownerauth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        // echo "<pre>";
        // print_r(session('login_data')->full_name);
        // exit;
        $language_id = Helper::currentLanguage()->id;
        $labels = Helper::LabelList($language_id);
        return view('businessOwner.dashboard.home',compact('labels'));
    }

    public function profileBuild(Request $request)
    {
        
        $language_id = Helper::currentLanguage()->id;
        $labels = Helper::LabelList($language_id);
        return view('businessOwner.dashboard.profile_build',compact('labels'));
    }
}
