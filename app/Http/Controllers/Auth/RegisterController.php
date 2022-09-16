<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\MainUsers;
use App\Models\Country;
use App\Models\Transaction;
use App\Models\Setting;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Mail;
use Stripe;
use Session;
use App\Helpers\Helper;
use DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    // use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }


    public function showSignupForm($subscription_id = NULL) {
        $plans = DB::table('subscription_plans')
                    ->select('subscription_plans.*')
                    ->where('subscription_plans.parent_id','=',0)->where('status','1');
        if($subscription_id != NULL){
          $plans_data = $plans->where('id',$subscription_id)->get();
        }else{
            $plans_data = $plans->take(1)->get();
        }
        
        $countries = Country::where('status','1')->get();
        $language_id = Helper::currentLanguage()->id;
        $labels = Helper::LabelList($language_id);


        $PageTitle = $labels['signup'];
        $PageDescription = "";
        $PageKeywords = "";
        $WebmasterSettings = "";
        return view('frontEnd.register', compact('language_id', 'labels', 'PageTitle', 'PageDescription', 'PageKeywords', 'WebmasterSettings','plans_data','countries'));
    }

    public function register(Request $request) {
        $validations = $this->validateRequest($request);
        if ($validations->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validations)
                        ->withInput();
        }
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $response = \Stripe\Token::create(array(
        "card" => array(
            "number" => $request->card_number,
            "exp_month" => $request->exp_month,
            "exp_year" => $request->exp_year,
            "cvc" => $request->cvc
        )
        ));
        $user = new MainUsers();
        $user->full_name = urlencode($request->fullname);
        $user->email = $request->email;
        $user->username = $request->businessOwner;
        $user->mobile_number = $request->mobile;
        $user->address = $request->address;
        $user->country_id = $request->country;
        $user->state_id = $request->state;
        $user->city_id = $request->city;
        $user->zipcode = $request->zipcode;
        $user->status = '1';
        $user->user_type = '1';
        $user->business_type_id = '1';
        $user->save(); 


        $transaction = new Transaction();
        $transaction->card_number = $request->card_number;
        $transaction->cvc = $request->cvc;
        $transaction->exp_month = $request->exp_month;
        $transaction->exp_year = $request->exp_year;
        $transaction->amount = 100.00;
        $transaction->save(); 
        if($response->id != ''){
            Stripe\Charge::create ([
                    "amount" => 100 * 100,
                    "currency" => "usd",
                    "source" => $response->id,
                    "description" => "Test payment from netcofintech."
            ]);
        }

        $language_id = "1";
        $logo = asset('assets/frontend/logo/logo.png');
        $url = '';
        $email = urldecode($request->email);
        $name = urldecode($request->fullname);
        $template_id = 1;
        $this->attachment_email($language_id, $email, $name, '', $logo, $template_id);
        // $setting = Setting::find(1);
        // $id =1;
        // $logo = asset('assets/frontend/logo/logo.png');
		// // dd($setting);
		// $templateData = Helper::getEmailTemplateData($language_id, $id);
		// // dd($templateData);

		// $from_email = $setting['from_email'];
		// $data = array('email' => $email, 'name' => $name, 'url' => $url, 'id' =>  $id, 'logo' => $logo, 'from_email' => $from_email);
		// // try {
		// Mail::send('emails.registration', $data, function ($message) use ($data, $templateData) {
		// 	$message->to($data['email'], $templateData->title)->subject($templateData->subject);
		// 	$message->from($data['from_email'], 'Netcofintech');
		// });
        // $plans = DB::table('subscription_plans')
        //             ->select('subscription_plans.*')
        //             ->where('subscription_plans.parent_id','=',0)->where('status','1');
        // if(isset($id)){
        //   $plans_data = $plans->where('id',$id)->get();
        // }else{
        //     $plans_data = $plans->take(1)->get();
        // }
        // // echo '<pre>';
        // // print_r($plans_data);
        // // exit;
        $language_id = Helper::currentLanguage()->id;
        $labels = Helper::LabelList($language_id);


        $PageTitle = $labels['signup'];
        $PageDescription = "";
        $PageKeywords = "";
        $WebmasterSettings = "";
        Session::flash('success', 'Register successfully done!');
        return redirect()->route('frontend.register')->with('doneMessage', __('backend.saveDone'));
    }

    public function attachment_email($language_id, $email, $name, $url, $logo, $id)
	{

		$setting = Setting::find(1);
		// dd($setting);
		$templateData = Helper::getEmailTemplateData($language_id, $id);
		// dd($templateData);

		$from_email = $setting['from_email'];
        $email = 'kanchi.p@mailinator.com';
		$data = array('email' => $email, 'name' => $name, 'url' => $url, 'id' =>  $id, 'logo' => $logo, 'from_email' => $from_email);
		// try {
		Mail::send('emails.registration', $data, function ($message) use ($data, $templateData) {
			$message->to($data['email'], $templateData->title)->subject($templateData->subject);
			$message->from($data['from_email'], 'Netcofintech');
		});
		// } catch (\Throwable $th) {
		// 	// throw $th;
		// }
	}

    public function validateRequest($request,$id="",$lang_id = "",$childId="")
    {
        $validation_messages = [
            'fullname.required' => 'Full name is required.',
            'fullname.string' => 'Only string allowed for First Name',
            'fullname.max' => 'Max length exceeded for First Name',
            'email.encoded_unique' => 'Email is already taken.',
            'mobile.required' => 'Mobile Number is required.',
        ];

            $validator = Validator::make($request->all(), [
                'fullname' => [
                                    'required',
                                    'string',
                                    'max:30',
                                ],
                'mobile' => [ 
                                    'required',
                                    'regex:/[0-9]{10}/',
                                    'max:16',
                                    
                                ],
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    'unique:App\Models\MainUsers,email,status,2',
                    'regex:/^\w+[-\.\w]*@(?!(?:outlook|myemail|yahoo)\.com$)\w+[-\.\w]*?\.\w{2,4}$/',  
                ],
                'businessOwner' => [
                    'required',
                    'string',
                    'max:70', 
                ],
                'state' => [
                    'required',
                ],
                'city' => [
                    'required',
                ],
                'country' => [
                    'required',
                ],
                // 'zipcode' => [
                //     'required',
                //     'regex:/[1-9][0-9]{5}/',
                // ],
                // 'cvc' => [
                //     'required',
                //     'regex:/[0-9]{3, 4}/',
                // ],
                'privacy_policy' => [
                    'required',
                ],
        ],
            $validation_messages
        );


        return $validator;
    }

    

}
