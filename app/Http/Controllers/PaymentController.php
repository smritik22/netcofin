<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;
use App\Models\MainUsers;
use App\Models\Setting;
use App\Models\SubscriptionPlan;
use App\Models\UserSubscription;
use App\Models\FeaturedAddons;

use Mail;
use DB;
use Carbon\Carbon;
use Str;
use Illuminate\Support\Facades\Storage;
use File;
use Session;
use Stripe;
use Symfony\Component\Console\Input\Input;

class PaymentController extends Controller
{
    //
    public function __construct() {

    }
    
    public function payment(Request $request) {

        // dd($request->all());
        if (! function_exists( 'curl_version' )) {
            exit ( "Something went wrong." );
        }

        $language_id = $request->input('language_id') ?: 1;
        $labels = Helper::LabelList($language_id);
        $is_web = $request->input('is_web');

        if($is_web) {
            $user_id = Auth::guard('web')->id();
        } else {
            $user_id = $request->input('user_id');
        }

        $user = MainUsers::find($user_id);
        $full_name = @urldecode(Auth::guard('web')->user()->full_name) ?: "";
        $email = @urldecode(Auth::guard('web')->user()->email) ?: "";
        $mobile_number = @Auth::guard('web')->user()->mobile_number ?: "";

        $fields = array(
            'merchant_id'=> '1201',
            'username' => 'test',
            'password'=> stripslashes('test'), 
            'api_key'=>'jtest123', // in sandbox request
            //'api_key' =>password_hash('API_KEY',PASSWORD_BCRYPT), //In production mode, please pass API_KEY with BCRYPT function
            'order_id'=>time() . '-' .time(), // MIN 30 characters with strong unique function (like hashing function with time)
            'total_price'=> $request->input('payable_amount') ? Helper::tofloat($request->input('payable_amount')) : 0,
            'CurrencyCode'=> 'KWD',//only works in production mode
            // 'CstFName'=> 'tester123',
            // 'CstEmail'=> 'mypage@mailinator.com',
            // 'CstMobile'=> 9999999999,
            'CstFName'=> $full_name,
            'CstEmail'=> $email,
            'CstMobile'=> $mobile_number,
            'success_url'=> ($is_web==1) ? route('frontend.payment.success',['id'=>'web']) : route('frontend.payment.success'),
            'error_url'=> ($is_web==1) ? route('frontend.payment.error',['id'=>'web']) : route('frontend.payment.error'),
            // 'success_url'=> 'www.google.com',
            // 'error_url'=> 'www.vrinsofts.com',
            'test_mode'=> 1, // test mode enabled
            'whitelabled'=> true, // only accept in live credentials (it will not work in test)
            // 'payment_gateway'=> 'knet',// only works in production mode
            // 'ProductName'=>json_encode(['computer','television']),
            // 'ProductQty'=>json_encode([2,1]),
            // 'ProductPrice'=>json_encode([150,1500]),
            'reference'=> 'Ref'.time()
        );

        $HEADERS = array('x-Authorization:hWFfEkzkYE1X691J4qmcuZHAoet7Ds7ADhL');

        $fields_string = http_build_query($fields);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://api.upayments.com/test-payment");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $HEADERS);

        // receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        
        // echo "<pre>";
        // print_r($server_output);
        // exit();
        $server_output = json_decode($server_output,true);


        if($server_output['status'] == 'success') {
            $result['code'] = (string) 1;
            $result['message'] = 'success';
            $result['message_label'] = 'success';
            $result['redirect_url'] = $server_output['paymentURL'];
            $result['success_url'] = route('frontend.payment.success');
            $result['error_url'] = route('frontend.payment.error');
        } else {
            $result['code'] = (string) 0;
            $result['message'] = $server_output['error_code'];
            $result['message_label'] = $server_output['error_code'];
            $result['redirect_url'] = @$server_output['paymentURL'] ?: "";
            $result['success_url'] = route('frontend.payment.success');
            $result['error_url'] = route('frontend.payment.error');
        }

        $mainResult[] = $result;
        return response()->json($mainResult);
    }


    public function payment_success(Request $request, $web="") {
        if($web) {
            return view('frontEnd.payment.result', compact($request));
        } else {
            return response()->json($request);
        }
    }

    public function payment_error(Request $request, $web="") {
        $response = $request->all();
        // dd($response);
        if($web) {
            return view('frontEnd.payment.result', compact('response'));
        } else {
            return response()->json($request);
        }
    }

    public function stripe()
    {
        return view('frontEnd.payment.stripe');
    }
   
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from netcofintech."
        ]);
   
        Session::flash('success', 'Payment successful!');
           
        return back();
    }
}
