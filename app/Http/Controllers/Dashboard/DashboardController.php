<?php

namespace App\Http\Controllers\Dashboard;

use App\Charts\PropertyChart;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Carbon\Carbon;
// use App\Charts\UserChart;
use App\Charts\UserProfileChart;
use App\Charts\RevenueChart;
use App\Charts\BusinessownerChart;
use App\Models\MainUsers;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Property;
use App\Models\SubscriptionPlan;
use App\Models\Transaction;
use App\Models\UserSubscription;
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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        // dd(Auth::user());
        if ($request->start_date != "" && $request->end_date) {
            if($request->start_date >= $request->end_date){
                return redirect()->back()->with("errorMessage","End date must be greater than start date.");
            }
            
            $filterdate = $request->date_filter;


            $start = Carbon::createFromFormat('d-m-Y', $request->start_date)->format('Y-m-d');
            $end = Carbon::createFromFormat('d-m-Y', $request->end_date)->format('Y-m-d');
            // Plateform Users Data
            $total_users = MainUsers::where('status', '!=', 2)->where('user_type', '!=', '1')->whereBetween('created_at', [$start, $end])->count();
            $total_busineowners = MainUsers::where('status', '!=', 2)->where('user_type', '=', '1')->whereBetween('created_at', [$start, $end])->count();
            $total_categories = Category::where('status', '!=', '2')->whereBetween('created_at', [$start, $end])->count();
            $subscriptions_number = SubscriptionPlan::whereBetween('created_at', [$start, $end])->count();
            $revenue_generated = Transaction::whereBetween('created_at', [$start, $end])->sum('amount');
            $total_subcategories = SubCategory::where('status', '!=', '2')->count();

            /*
            |====================================================
            |
            | CHART & GRAPHS STARTS FROM HERE
            | 
             */

            // Users Graph Data fetch
            
            $user_normal_active = MainUsers::where('status', '=', 1)->where('user_type', '!=', "1")->whereBetween('created_at', [$start, $end])->count();
            $user_normal_active_deactive = MainUsers::where('status', '=', 0)->where('user_type', '!=', "1")->whereBetween('created_at', [$start, $end])->count();

            $user_business_owner_active = MainUsers::where('status', '=', 1)->where('user_type', '=', '1')->whereBetween('created_at', [$start, $end])->count();
            $user_business_owner_active_deactive = MainUsers::where('status', '=', 0)->where('user_type', '=', '1')->whereBetween('created_at', [$start, $end])->count();
            // Create Users Graph
            $userProfileGraph = new UserProfileChart;

            $userProfileGraph->labels(['Active General User', 'Inactive General User', 'Active Business Owners', 'Inactive Business Owners']);
            $userProfileGraph->dataset('Users', 'pie', [$user_normal_active, $user_normal_active_deactive, $user_business_owner_active, $user_business_owner_active_deactive])->color('#fff')->backgroundcolor(['#3699FF', 'red', '#2a4b9b', '#4a1006']);

            // REVENUE GRAPH DATA FETCH 
            $subscriptionData = Transaction::select(\DB::raw("sum(amount) as revenue"), \DB::raw('DATE_FORMAT(created_at, "%M") as Month'))
                ->whereYear('created_at', date('Y'))
                ->whereBetween('created_at',[$start,$end])
                ->groupBy(\DB::raw("Month"))
                ->get()->toArray();


            $months = array(1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December');
            $revenue = [];

            if ($subscriptionData) {
                $mon = array_reduce($subscriptionData, function ($a, $b) {
                    isset($a[$b['Month']]) ? $a[$b['Month']]['revenue'] : $a[$b['Month']] = $b;
                    return $a;
                });

                foreach ($months as $key => $value) {

                    if (isset($mon[$value]['revenue'])) {
                        array_push($revenue, $mon[$value]['revenue']);
                    } else {
                        array_push($revenue, 0);
                    }
                }
            }

            $revenueChart = new RevenueChart;
            $revenueChart->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']);
            $revenueChart->dataset('Monthly Transaction', 'bar', $revenue)->color('#2a4b9b')->backgroundcolor("#2a4b9b");
            $start = $request->start_date;
            $end = $request->end_date;

            $businessOwners_data = MainUsers::select(\DB::raw("count(id) as businessOwnerChartData"),\DB::raw('DATE_FORMAT(created_at, "%M") as Month'))->where('status','1')->where('user_type','1')->whereYear('created_at', date('Y'))->whereBetween('created_at',[$start,$end])->groupBy(\DB::raw("Month"))->get()->toArray();
          
            $businessOwners = [];

            if ($businessOwners_data) {
                $mon = array_reduce($businessOwners_data, function ($a, $b) {
                    isset($a[$b['Month']]) ? $a[$b['Month']]['businessOwnerChartData'] : $a[$b['Month']] = $b;
                    return $a;
                });

                foreach ($months as $key => $value) {

                    if (isset($mon[$value]['businessOwnerChartData'])) {
                        array_push($businessOwners, $mon[$value]['businessOwnerChartData']);
                    } else {
                        array_push($businessOwners, 0);
                    }
                }
            }
            $businessownerChart = new BusinessownerChart;
            $businessownerChart->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']);
            $businessownerChart->dataset('Monthly Register', 'bar', $businessOwners)->color('#2a4b9b')->backgroundcolor("#2a4b9b");
            return view('dashboard.home', compact('start', 'end', 'total_users','revenue_generated', 'subscriptions_number', 'revenueChart', 'userProfileGraph','total_busineowners','total_categories','total_subcategories','businessownerChart'));
        } else {

            $start = '';
            $end = '';

            // Plateform Users Data
            $total_users = MainUsers::where('status', '!=', 2)->where('user_type', '!=', '1')->count();
            $total_busineowners = MainUsers::where('status', '!=', 2)->where('user_type', '=', '1')->count();
            $total_categories = Category::where('status', '!=', '2')->count();
            $total_subcategories = SubCategory::where('status', '!=', '2')->count();
            // Subscriptions and revenue
            // $subscriptions_number = UserSubscription::count();
            $subscriptions_number = SubscriptionPlan::count();
            // $revenue_generated = UserSubscription::sum('total_price');
            $revenue_generated = Transaction::sum('amount');
            

            /*
            |====================================================
            |
            | CHART & GRAPHS STARTS FROM HERE
            | 
             */

            // $start = Carbon::now()->format('m-d-Y');
            // $end = Carbon::now()->format('m-d-Y');

            // Users Graph Data fetch
            $user_normal_active = MainUsers::where('status', '=', "1")->where('user_type', '!=', "1")->count();
            $user_normal_active_deactive = MainUsers::where('status', '=', "0")->where('user_type', '!=', "1")->count();

            $user_business_owner_active = MainUsers::where('status', '=', "1")->where('user_type', '=', '1')->count();
            $user_business_owner_active_deactive = MainUsers::where('status', '=', "0")->where('user_type', '=', '1')->count();
            
            
            // Create Users Graph
            $userProfileGraph = new UserProfileChart;

            $userProfileGraph->labels(['Active General User', 'Inactive General User', 'Active Business Owners', 'Inactive Business Owners']);
            $userProfileGraph->dataset('Users', 'pie', [$user_normal_active, $user_normal_active_deactive, $user_business_owner_active, $user_business_owner_active_deactive])->color('#fff')->backgroundcolor(['#3699FF', 'red', '#2a4b9b', '#4a1006']);

            // REVENUE GRAPH DATA FETCH 
            $subscriptionData = Transaction::select(\DB::raw("sum(amount) as revenue"), \DB::raw('DATE_FORMAT(created_at, "%M") as Month'))
                ->whereYear('created_at', date('Y'))
                ->groupBy(\DB::raw("Month"))
                ->get()->toArray();


            $months = array(1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December');
            $revenue = [];

            if ($subscriptionData) {
                $mon = array_reduce($subscriptionData, function ($a, $b) {
                    isset($a[$b['Month']]) ? $a[$b['Month']]['revenue'] : $a[$b['Month']] = $b;
                    return $a;
                });

                foreach ($months as $key => $value) {

                    if (isset($mon[$value]['revenue'])) {
                        array_push($revenue, $mon[$value]['revenue']);
                    } else {
                        array_push($revenue, 0);
                    }
                }
            }

           
            $revenueChart = new RevenueChart;
            $revenueChart->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']);
            $revenueChart->dataset('Monthly Transaction', 'bar', $revenue)->color('#2a4b9b')->backgroundcolor("#2a4b9b");

            $businessOwners_data = MainUsers::select(\DB::raw("count(id) as businessOwnerChartData"),\DB::raw('DATE_FORMAT(created_at, "%M") as Month'))->where('status','1')->where('user_type','1')->whereYear('created_at', date('Y'))->groupBy(\DB::raw("Month"))->get()->toArray();
          
            $businessOwners = [];

            if ($businessOwners_data) {
                $mon = array_reduce($businessOwners_data, function ($a, $b) {
                    isset($a[$b['Month']]) ? $a[$b['Month']]['businessOwnerChartData'] : $a[$b['Month']] = $b;
                    return $a;
                });

                foreach ($months as $key => $value) {

                    if (isset($mon[$value]['businessOwnerChartData'])) {
                        array_push($businessOwners, $mon[$value]['businessOwnerChartData']);
                    } else {
                        array_push($businessOwners, 0);
                    }
                }
            }
            $businessownerChart = new BusinessownerChart;
            $businessownerChart->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']);
            $businessownerChart->dataset('Monthly Register', 'bar', $businessOwners)->color('#2a4b9b')->backgroundcolor("#2a4b9b");


            return view('dashboard.home', compact('start', 'end', 'total_users', 'revenue_generated', 'subscriptions_number', 'revenueChart', 'userProfileGraph','total_busineowners','total_categories','total_subcategories','businessownerChart'));
        }
    }
}
