<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Models\Area;
use App\Models\Cms;
use App\Models\PropertyType;
use App\Models\Property;
use App\Models\City;
use App\Models\State;
use App\Models\Setting;
use App\Models\WebmasterSetting;

use Auth;
use Mail;
use Session;
use DB;
use Validator;

class HomeController extends Controller
{
    private $uploadPath = "/uploads/cms/";
    protected $image_uri = "";
    protected $no_image = "";

    public function __construct()
    {
        // $this->middleware('auth');
        $this->setImagePath();
        $this->no_image = asset('assets/dashboard/images/no_image.png');
    }

    public function getImagePath(){
        return $this->uploadPath;
    }

    public function setImagePath(){
        $this->image_uri = $this->getImagePath() . '/';
    }

    public function getUploadPath()
    {
        return $this->uploadPath;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $setting = Setting::first();
        $WebmasterSettings = WebmasterSetting::first();
        $language_id = Helper::currentLanguage()->id;
        $labels = Helper::LabelList($language_id);

        Session::forget('isForgotPass');
        Session::forget('user_id_1');

        $language_id = Helper::currentLanguage()->id;
        $labels = Helper::LabelList($language_id);

        $cms_id = 6;
        $about_us = Cms::find($cms_id);
       
        $cms_id = 9;
        $features = Cms::find($cms_id);

        $plans = DB::table('subscription_plans')
                    ->select('subscription_plans.*')
                    ->where('subscription_plans.parent_id','=',0)->where('status','1')->take(3)->get();
        $PageTitle = $labels['home_page_title']; 
        $PageDescription = "";
        $PageKeywords = "";
        $WebmasterSettings = "";
        $headerFill = 1;
        
        return view('frontEnd.home', compact('PageTitle', 'PageDescription', 'PageKeywords', 'labels', 'language_id', 'headerFill','about_us','features','plans','setting','WebmasterSettings'));
    }

    public function about_us(Request $request ) {
        $language_id = Helper::currentLanguage()->id;
        $labels = Helper::LabelList($language_id);

        $cms_id = 6;
        $cms_data = Cms::find($cms_id);

        if($cms_data) {
            $image_url = isset($this->image_uri) ? $this->image_uri : '';
            $PageTitle = ( $language_id != 1 && @$cms_data->childdata[0]->page_name ) ? $cms_data->childdata[0]->page_name : $cms_data->page_name;
            $PageDescription = ( $language_id != 1 && @$cms_data->childdata[0]->description ) ? strip_tags($cms_data->childdata[0]->description) : strip_tags($cms_data->description);
            $PageKeywords = "";
            $WebmasterSettings = "";
    
            return view('frontEnd.cms.about', compact('image_url','cms_data', 'language_id', 'labels', 'PageTitle', 'PageDescription', 'PageKeywords', 'WebmasterSettings'));
        } else {
            return redirect()->route('frontend.not_found');
        }
    }

    public function terms_and_conditions(Request $request ) {
        $language_id = Helper::currentLanguage()->id;
        $labels = Helper::LabelList($language_id);

        $cms_id = 3;
        $cms_data = Cms::find($cms_id);

        if($cms_data) {

            $PageTitle = ( $language_id != 1 && @$cms_data->childdata[0]->page_name ) ? $cms_data->childdata[0]->page_name : $cms_data->page_name;
            $PageDescription = ( $language_id != 1 && @$cms_data->childdata[0]->description ) ? strip_tags($cms_data->childdata[0]->description) : strip_tags($cms_data->description);
            $PageKeywords = "";
            $WebmasterSettings = "";
    
            return view('frontEnd.cms.terms', compact('cms_data', 'language_id', 'labels', 'PageTitle', 'PageDescription', 'PageKeywords', 'WebmasterSettings'));
        } else {
            return redirect()->route('frontend.not_found');
        }
    }


    public function privacy_policy(Request $request ) {
        $language_id = Helper::currentLanguage()->id;
        $labels = Helper::LabelList($language_id);

        $cms_id = 1;
        $cms_data = Cms::find($cms_id);

        if($cms_data) {

            $PageTitle = ( $language_id != 1 && @$cms_data->childdata[0]->page_name ) ? $cms_data->childdata[0]->page_name : $cms_data->page_name;
            $PageDescription = ( $language_id != 1 && @$cms_data->childdata[0]->description ) ? strip_tags($cms_data->childdata[0]->description) : strip_tags($cms_data->description);
            $PageKeywords = "";
            $WebmasterSettings = "";
    
            return view('frontEnd.cms.privacy', compact('cms_data', 'language_id', 'labels', 'PageTitle', 'PageDescription', 'PageKeywords', 'WebmasterSettings'));
        } else {
            return redirect()->route('frontend.not_found');
        }
    }


    public function features(Request $request ) {
        $language_id = Helper::currentLanguage()->id;
        $labels = Helper::LabelList($language_id);

        $cms_id = 9;
        $cms_data = Cms::find($cms_id);

        if($cms_data) {
            $image_url = isset($this->image_uri) ? $this->image_uri : '';
            $PageTitle = ( $language_id != 1 && @$cms_data->childdata[0]->page_name ) ? $cms_data->childdata[0]->page_name : $cms_data->page_name;
            $PageDescription = ( $language_id != 1 && @$cms_data->childdata[0]->description ) ? strip_tags($cms_data->childdata[0]->description) : strip_tags($cms_data->description);
            $PageKeywords = "";
            $WebmasterSettings = "";
    
            return view('frontEnd.cms.feature', compact('image_url','cms_data', 'language_id', 'labels', 'PageTitle', 'PageDescription', 'PageKeywords', 'WebmasterSettings'));
        } else {
            return redirect()->route('frontend.not_found');
        }
    }

    public function faqs(Request $request ) {
        $language_id = Helper::currentLanguage()->id;
        $labels = Helper::LabelList($language_id);

        $cms_id = 5;
        $cms_data = Cms::find($cms_id);

        if($cms_data) {

            $PageTitle = ( $language_id != 1 && @$cms_data->childdata[0]->page_name ) ? $cms_data->childdata[0]->page_name : $cms_data->page_name;
            $PageDescription = ( $language_id != 1 && @$cms_data->childdata[0]->description ) ? strip_tags($cms_data->childdata[0]->description) : strip_tags($cms_data->description);
            $PageKeywords = "";
            $WebmasterSettings = "";
    
            return view('frontEnd.cms.faqs', compact('cms_data', 'language_id', 'labels', 'PageTitle', 'PageDescription', 'PageKeywords', 'WebmasterSettings'));
        } else {
            return redirect()->route('frontend.not_found');
        }
    }


    public function contact_us() {
        $language_id = Helper::currentLanguage()->id;
        $labels = Helper::LabelList($language_id);
        $setting = Setting::first();

        $PageTitle = $labels['contact_us'];
        $PageDescription ="";
        $WebmasterSettings = WebmasterSetting::first();
        $PageKeywords  ="";
        return view('frontEnd.contact', compact('language_id', 'labels','PageTitle','PageDescription','PageKeywords', 'WebmasterSettings', 'setting'));
    }

    public function submit_contactus(Request $request) {
        $user_id = "";
        if(Auth::check()) {
            $user_id = Auth::id();
        }
        $validations = $this->validateRequest($request);
        if ($validations->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validations)
                        ->withInput();
        }
        $language_id = Helper::currentLanguage()->id;
        $labels = Helper::LabelList($language_id);

        $full_name = $request->input('name');
        $email = $request->input('email');
        $mobile_no = $request->input('mobile');
        $country_code = $request->input('country_code');
        $message = $request->input('message');

        $setting = Setting::find(1);
		$admin_email = $setting->email;

        $template_id = 9;
        // $this->sendEmail($language_id, $admin_email, $email, $full_name, $mobile_no, $country_code, $message, "", "", "", $template_id);

        $response = [];
        $response['statusCode'] = 200;
        $response['message'] = $labels['mail_sent_to_admin'];
        $response['title'] = $labels['mail_sent_to_admin'];
        $response['url'] = route('frontend.thankyou');

        return redirect()->route('frontend.thankyou');
    }

    //mail
	public function sendEmail($language_id, $email, $user_email, $name, $mobile_no, $country_code, $report_message, $agent_id ="", $url = "", $logo = "", $id)
	{
		$setting = Setting::find(1);
		// dd($setting);
		$templateData = Helper::getEmailTemplateData($language_id, $id);
		// dd($templateData);

		$from_email = $setting['from_email'];
		$data = array('email' => $email, "user_email" => $user_email, 'name' => $name, 'url' => $url, "phone" => $mobile_no, "country_code" => $country_code, "language_id" => $language_id, 'id' =>  $id, "agent_id" => $agent_id, 'logo' => $logo, 'from_email' => $from_email, "report_message" => $report_message);	
		// try {
		Mail::send('emails.report_agent', $data, function ($message) use ($data, $templateData) {
			$message->to($data['email'], $templateData->title)->subject($templateData->subject);
			$message->from($data['from_email'], 'DOM - Properties');
		});
		// } catch (\Throwable $th) {
		// 	// throw $th;
		// }
	}

    public function validateRequest($request,$id="",$lang_id = "",$childId="")
    {
        $validation_messages = [
            'firstname.required' => 'FirstName is required.',
            'firstname.string' => 'Only string allowed for First Name',
            'firstname.max' => 'Max length exceeded for First Name',
            'lastname.required' => 'Last Name is required.',
            'lastname.string' => 'Only string allowed for Last Name',
            'lastname.max' => 'Max length exceeded for Last Name',
            'mobile.required' => 'Mobile Number is required.',
        ];

            $validator = Validator::make($request->all(), [
                'firstname' => [
                                    'required',
                                    'string',
                                    'max:30',
                                ],
                'lastname' => [
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
                    'regex:/^\w+[-\.\w]*@(?!(?:outlook|myemail|yahoo)\.com$)\w+[-\.\w]*?\.\w{2,4}$/',  
            ],
        ],
            $validation_messages
        );


        return $validator;
    }
    public function thank_you() {
        $language_id = Helper::currentLanguage()->id;
        $labels = Helper::LabelList($language_id);

        $PageTitle = $labels['contact_us'];
        $PageDescription = "";
        $PageKeywords = "";
        $WebmasterSettings = "";
        return view('frontEnd.thank_you', compact('language_id', 'labels', 'PageTitle', 'PageDescription', 'PageKeywords', 'WebmasterSettings'));
    }

    public function getState(Request $request)
    {
        $state = State::where('status',"1")->where('country_id',$request->id)->select('name','id')->get()->toArray();
        $data_arr = [];
        if(!empty($state)){
            $data_arr[] = "<option>Select state</option>";
            foreach ($state as $key => $value) {
                $data_arr[] = "<option value='".$value['id']."'>".urldecode($value['name'])."</option>";
            }
        }else{
            $data_arr[] = "<option>No data</option>";
        }
        echo json_encode($data_arr);
    }

    public function getCity(Request $request)
    {
        $city = City::where('status',"1")->where('state_id',$request->id)->where('country_id',$request->id)->select('name','id')->get()->toArray();
        $data_arr = [];
        if(!empty($city)){
            $data_arr[] = "<option>Select city</option>";
            foreach ($city as $key => $value) {
                $data_arr[] = "<option value='".$value['id']."'>".urldecode($value['name'])."</option>";
            }
        }else{
            $data_arr[] = "<option>No data</option>";
        }
        echo json_encode($data_arr);
    }

    public function index_new($subdomain)
    {
      echo $subdomain;
      exit;
    }

}
