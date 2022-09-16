<?php

namespace App\Http\Controllers\BusinessOwner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Helper;
use Session;
use Hash;
use Auth;
use App\Models\MainUsers;
use App\Models\SubscriptionPlan;
use App\Models\BusinessProfile;


class LoginBusinessOwnerController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('customdomain');
    }

    public function showBusinessOwnerLoginForm($domain)
    {
        $is_domain = Mainusers::where('username',$domain)->get()->toArray();
        if(empty($is_domain)){
            $language_id = Helper::currentLanguage()->id;
            $labels = Helper::LabelList($language_id);

            $subscription_plans = SubscriptionPlan::with(['childdata' => function ($child) use ($language_id){
                    return $child->where('language_id', '=', $language_id);
                }])
                ->where('parent_id', '=', 0)
                ->where('status', '=', 1)
                ->get();
            
            $PageTitle = $labels['subscription_plan'];
            $PageDescription = "";
            $PageKeywords = "";
            $WebmasterSettings = "";

            return view('frontEnd.subscription.subscription_plans_list', compact('language_id', 'labels', 'PageTitle', 'PageDescription', 'PageKeywords', 'WebmasterSettings', 'subscription_plans','domain'));
                // redirect('')
        }
            return view('businessOwner.auth.login');
    }

    public function login_old(Request $request) {
        $language_id = Helper::currentLanguage()->id;
        $labels = Helper::LabelList($language_id);
        $user = MainUsers::where('email', '=', $request->email)->latest('id');
		if (@$user->exists()) {
			return view('businessOwner.dashboard.home',compact('labels'));
		}
    }

    public function login(Request $request)
    {
        $this->validate(
            $request,
            [
                'email' => 'required|email|exists:users,email',
                'password' => 'required',
            ],
            [
                'email.exists' => 'These credentials do not match our records.',
            ]
        );
        $remember_me = $request->has('remember_me') ? true : false;

        if (MainUsers::where('email', '=', $request->input('email'))->where('password', \Hash::make($request['password']))->where('user_type',1)) {
            if ($remember_me == true) {
                $minutes = 120;

                Cookie::queue('email',  $request->input('email'), $minutes);
                Cookie::queue('password', $request->input('password'), $minutes);
            } else {
                \Cookie::queue(\Cookie::forget('email'));
                \Cookie::queue(\Cookie::forget('password'));
            }
            $user = MainUsers::where(["email" => $request->input('email')])->first();
            session(['login_data' => $user]);
    
            Auth::login($user, $remember_me);
            
            MainUsers::where('email', '=', $request->input('email'))->update(["status" =>1]);
            // $language_id = Helper::currentLanguage()->id;
            // $labels = Helper::LabelList($language_id);
            $user = MainUsers::where('email', '=', $request->email)->latest('id');
            
            if (@$user->exists()) {
                // $profile_setup = BusinessProfile::where('user_id', '=', $user->get()->toArray()[0]['id'])->where('status','1')->latest('id');
                // if($profile_setup->exists()){
                    return redirect(url('admin/businessOwnerHome'));
                // }else{
                //     return redirect(url('setup'));
                // }
            }
        } else {

            return back()->withInput($request->input())->with('error', 'Your email or password is invalid.');
        }
    }
    
}
