<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MainUsers as MainUser;
use App\Models\Property;
use App\Models\UserSubscription;
use App\Models\Setting;
use App\Models\EmailTemplate;
use App\Models\UserConversation;
use App\Models\UserFavouriteProperty;
use App\Models\PropertyImages;
use App\Models\ReportUser;

use App\Helpers\Helper;
use File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Mail;
use Hash;
use PDO;
use DB;
use App\Models\UserFeaturedAddons;
use Carbon\Carbon;

class UserController extends Controller
{
	protected $chat_per_page;
	protected $messages_per_page;
	protected $fav_property_per_page;
	protected $my_ads_per_page;

	public function __construct()
	{
		$this->chat_per_page = 10;
		$this->messages_per_page = 15;
		$this->fav_property_per_page = 10;
		$this->my_ads_per_page = 10;
	}
	//
	public static function phoneExist($phone, $country_code, $edit = '')
	{
		if ($edit != '') {
			$data = MainUser::where([
				['mobile_number', '=', trim(urldecode($phone))],
				['country_code', '=', urlencode(trim($country_code))],
				['status', '!=', '2'],
				['is_otp_varified', '=', 1],
				['id', '!=', $edit],
			])->count();
		} else {
			$data = MainUser::where([
				['mobile_number', '=', trim(urldecode($phone))],
				['country_code', '=', urlencode(trim($country_code))],
				['is_otp_varified', '=', 1],
				['status', '!=', '2'],
			])->count();
		}
		return $data;
	}

	public static function emailExist($email, $edit = '')
	{
		if ($edit != '') {
			$data = MainUser::where([
				['email', '=', urlencode(trim($email))],
				['status', '!=', '2'],
				['is_otp_varified', '=', 1],
				['id', '!=', $edit],
			])->count();
		} else {
			$data = MainUser::where([
				['email', '=', urlencode(trim($email))],
				['is_otp_varified', '=', 1],
				['status', '!=', '2'],
			])->count();
		}
		return $data;
	}

	public function sendOtp($phone, $country_code, $otp)
	{
		Helper::sendOtp($phone, $country_code, $otp);
	}

	public function register(Request $request)
	{
		// $validator = \Validator::make($request->all(), [
		//     'full_name' => 'required',
		//     'country_code' => 'required',
		//     'mobile_no' => 'required',
		//     'email' => 'required',
		//     'password' => 'required',
		// ]);

		// if ($validator->fails()) {
		//     return response()->json([
		//         'status_code' => 200,
		//         'error'=>$validator->messages(),
		//         'data' => null
		//     ], 200);
		// }

		$post = $request->all();
		if ($post) {

			$post['password'] = Hash::make($request->password);
			if (!empty($request->input('mobile_no'))) {
				$detail2 = $this->phoneExist($request->input('mobile_no'), $request->input('country_code'));
				if ($detail2 > 0) {
					$result['code'] = (string) -4;
					$result['message'] = 'mobile_already_taken';
					$result['result'] = [];
					$mainResult[]   =   $result;
					return response()->json($mainResult);
				}
			}
			if (!empty($request->input('email'))) {
				$emailExists = $this->emailExist($request->input('email'));
				if ($emailExists > 0) {
					$result['code'] = (string) -5;
					$result['message'] = 'email_already_taken';
					$result['result'] = [];
					$mainResult[]   =   $result;
					return response()->json($mainResult);
				}
			}

			$post['full_name']   = isset($request->full_name) ? urlencode($request->full_name) : "";
			$post['mobile_number'] = isset($request->mobile_no) ? $request->mobile_no : '';
			$post['email'] = isset($request->email) ? urlencode($request->email) : '';
			$post['country_code'] = isset($request->country_code) ? urlencode($request->country_code) : '';
			$post['status'] = 2;
			$post['user_type'] = config('constants.USER_TYPE_GENERAL');
			$post['is_otp_varified'] = 0;
			$post['remember_token'] = $this->generateToken();
			$post['device_type'] = isset($request->device_type) ? $request->device_type : '';
			$post['device_token'] = isset($request->device_token) ? $request->device_token : '';

			$otp_send = 0;
			$otp = $this->generateOTP();
			if (@$request->mobile_no && @$request->country_code) {
				$post['otp'] = $otp;
				$otp_send = $this->sendOtp($request->mobile_no, $request->country_code, $post['otp']);
				$post['otp_expire_time'] = date('Y-m-d H:i:s', strtotime(Helper::getOtpExpireTime()));
			} else {
				$result['code']    = (string) 0;
				$result['message'] = 'mobile_number_required';
				$result['result']  = [];

				$mainResult[] = $result;
				return response()->json($mainResult);
			}

			$user =  new MainUser($post);
			if ($user->save()) {

				$userData = [];
				$userData['user_id'] = (string) $user->id;
				$userData['full_name'] = @urldecode($user->full_name) ?: "";
				$userData['email'] = @urldecode($user->email) ?: "";
				$userData['mobile_no'] = (string) @$user->mobile_number ?: "";
				$userData['country_code'] = (string) @urldecode($user->country_code) ?: "";
				$userData['user_type'] = (string) $user->user_type;
				$userData['agent_type'] = (string) $user->agent_type;
				$userData['token'] = (string) $user->remember_token;
				$userData['otp'] = (string) $user->otp;
				$userData['otp_expiration_date_time'] = (string) $user->otp_expire_time;

				$startTime = Carbon::parse(date('Y-m-d H:i:s'));
				$finishTime = Carbon::parse($user->otp_expire_time);

				$totalDuration = $finishTime->diffInSeconds($startTime);

				$userData['otp_expiration_time'] = (string) $totalDuration;

				$result['code']    = (string) 1;
				$result['message'] = 'registered_successfully';
				$result['result'][]  = $userData;
			} else {
				$result['code']     = (string) 0;
				$result['message']  = 'something_wrong';
				$result['result']   = [];
			}
		} else {
			$result['code']     = (string) 0;
			$result['message']  = 'something_wrong';
			$result['result']   = [];
		}

		$mainResult[]   =   $result;
		return response()->json($mainResult);
	}

	// user login process
	public function login(Request $request)
	{
		$result = [];

		$user = MainUser::where('is_otp_varified', '=', 1)->where('mobile_number', '=', $request->mobile_no)->where('country_code', '=', urlencode($request->country_code))->latest('id');

		if (@$user->exists()) {
			$user_data = $user->first();

			if ($user_data->status == 0) {
				$result['code']     = (string) -3;
				$result['message']  = 'inactive_account';
				$result['result']   = [];

				$mainResult[] = $result;
				return response()->json($mainResult);
			} else if ($user_data->status == 2) {
				$result['code']     = (string) -2;
				$result['message']  = 'account_deleted_contact_to_admin';
				$result['result']   = [];

				$mainResult[] = $result;
				return response()->json($mainResult);
			}

			$validate = Hash::check($request->input('password'), $user_data->password);

			if ($validate) {

				$token = $this->generateToken();

				$update['device_token'] = $request->device_token;
				$update['device_type'] = $request->device_type;
				$update['remember_token'] = $token;
				$user_data->update($update);

				$user_arr = [];
				$user_arr['user_id']       = (string) $user_data->id;
				$user_arr['full_name']     = urldecode($user_data->full_name);
				$user_arr['email']         = @urldecode($user_data->email) ?: "";
				$user_arr['mobile_no']     = (string) $user_data->mobile_number;
				$user_arr['country_code']  = (string) @urldecode($user_data->country_code) ?: "";
				$user_arr['user_type']     = (string) $user_data->user_type;
				$user_arr['agent_type']    = (string) @$user_data->agent_type ?: "";
				$user_arr['about_user']    = @$user_data->about_user ?: "";
				$user_arr['short_address'] = @$user_data->user_short_address ?: "";

				$profile_image = "";
				if (@$user_data->profile_image) {
					$profile_image = asset('uploads/general_users/' . $user_data->profile_image);
				}
				$user_arr['profile_image'] = $profile_image;
				$user_arr['token'] = (string) $user_data->remember_token;

				$result['code'] = (string) 1;
				$result['message'] = "success";
				$result['result'][] = $user_arr;
			} else {
				$result['code']     = (string) -1;
				$result['message']  = 'password_is_incorrect';
				$result['result']   = [];
			}
		} else {
			$result['code']     = (string) -7;
			$result['message']  = 'mobile_not_registered_with_us';
			$result['result']  = [];
		}

		$mainResult[] = $result;
		return response()->json($mainResult);
	}

	public function resend_otp(Request $request)
	{
		$user_id = $request->input('user_id');

		if (@$user_id) {

			$user_query = MainUser::find($user_id);

			if (@$user_query->exists()) {
				$userData = $user_query;

				$otp_send = 0;
				$post = [];
				$otp = $this->generateOTP();
				if (@$userData->mobile_number && @$userData->country_code) {
					$post['otp'] = $otp;
					$otp_send = $this->sendOtp($userData->mobile_number, $userData->country_code, $post['otp']);
					$post['otp_expire_time'] = date('Y-m-d H:i:s', strtotime('+1 minutes'));

					$userData->otp = $post['otp'];
					$userData->otp_expire_time = $post['otp_expire_time'];

					if (@$userData->save()) {

						$response = [];
						$response['otp']   = (string) @$userData->otp ?: "";
						$response['otp_expiration_date_time'] = (string) $userData->otp_expire_time;

						$startTime = Carbon::parse(date('Y-m-d H:i:s'));
						$finishTime = Carbon::parse($userData->otp_expire_time);
						$totalDuration = $finishTime->diffInSeconds($startTime);

						$response['otp_expiration_second'] = (string) $totalDuration;

						$response['user_id'] = (string) $userData->id;
						$response['country_code'] = (string) @urldecode($userData->country_code) ?: "";
						$response['mobile_no'] = (string) @$userData->mobile_number ?: "";

						$result['code']     = (string) 1;
						$result['message']  = 'otp_sent_success';
						$result['result'][] = $response;
					} else {
						$result['code']     = (string) 0;
						$result['message']  = 'server_not_responding';
						$result['result']   = [];
					}
				} else {
					$result['code']    = (string) 0;
					$result['message'] = 'invalid_mobile_password';
					$result['result']  = [];
				}
			} else {
				$result['code']     = (string) 0;
				$result['message']  = 'no_data_found';
				$result['result']   = [];
			}
		} else {
			$result['code']     = (string) 0;
			$result['message']  = 'server_not_responding';
			$result['result']   = [];
		}

		$mainResult[] = $result;
		return response()->json($mainResult);
	}

	public function verify_otp(Request $request)
	{
		$user_id = $request->input('user_id');
		$otp = $request->input('otp_no');
		$otp_verify_type = $request->input('otp_verify_type');
		$language_id = $request->input('language_id');

		if (@$user_id && @$otp) {
			$userData = MainUser::find($user_id);

			if (@$userData) {

				if ($userData->otp == $otp) {

					if($userData->otp_expire_time < date('Y-m-d H:i:s')){
						$result['code'] = (string) 0;
						$result['message'] = "otp_expired";
						$result['result'] = [];

						$mainResult = $result;
						return response()->json($mainResult);
					}
					
					$update = [];

					$token = $this->generateToken();

					$update['device_token'] = $request->device_token;
					$update['device_type'] = $request->device_type;
					$update['remember_token'] = $token;
					$update['is_otp_varified'] = 1;
					$update['status'] = 1;
					$userData->update($update);

					if ($otp_verify_type == config('constants.otp_varify_type_register') && @$userData->email) {

						$logo = asset('assets/frontend/logo/logo.png');
						$url = '';
						$email = urldecode($userData->email);
						$name = urldecode($userData->full_name);
						$template_id = 1;
						$this->attachment_email($language_id, $email, $name, '', $logo, $template_id);
					}

					$user_arr = [];
					$user_arr['user_id']      = (string) $userData->id;
					$user_arr['full_name']    = urldecode($userData->full_name);
					$user_arr['email']        = @urldecode($userData->email) ?: "";
					$user_arr['mobile_no']    = (string) $userData->mobile_number;
					$user_arr['country_code'] = (string) @urldecode($userData->country_code) ?: "";
					$user_arr['user_type']    = (string) $userData->user_type;
					$user_arr['agent_type']   = (string) @$userData->agent_type ?: "";
					$user_arr['about_user']    = (string) @$userData->about_user ?: "";
					$user_arr['short_address'] = (string) @$userData->user_short_address ?: "";

					$profile_image = "";
					if (@$userData->profile_image) {
						$profile_image = asset('uploads/general_users/' . $userData->profile_image);
					}
					$user_arr['profile_image'] = $profile_image;
					$user_arr['token'] = (string) $userData->remember_token;

					$result['code'] = (string) 1;
					$result['message'] = "success";
					$result['result'][] = $user_arr;
				} else {
					$result['code']     = (string) 0;
					$result['message']  = 'otp_not_matched';
					$result['result']   = [];
				}
			} else {
				$result['code']     = (string) 0;
				$result['message']  = 'no_data_found';
				$result['result']   = [];
			}
		} else {
			$result['code']     = (string) 0;
			$result['message']  = 'server_not_responding';
			$result['result']   = [];
		}

		$mainResult[] = $result;
		return response()->json($mainResult);
	}


	public function logout(Request $request)
	{
		$userData = MainUser::where('id', $request->user_id)->where('status', '!=', 2)->where('is_otp_varified', '=', 1)->first();

		if (isset($userData) && !empty($userData)) {
			$userData->update(['remember_token' => '', 'device_token' => ' ', 'device_type' => '', 'device_id' => '']);

			$result = array();
			$result['code']     =  (string) 1;
			$result['message']  = "logout_success";
		} else {
			$result['code']     =  (string) 0;
			$result['message']  =   'no_data_found';
		}

		$mainResult[] = $result;
		return response()->json($mainResult);
	}

	public function forgot_password(Request $request)
	{

		$result = [];
		if (empty($request->mobile_no) || empty($request->country_code)) {
			$result['code']    = (string) 0;
			$result['message'] = 'mobile_number_required';
			$result['result']  = [];

			$mainResult[] = $result;
			return response()->json($mainResult);
		}

		$userCheck = MainUser::where('mobile_number', $request->mobile_no)->where('country_code', urlencode(trim($request->country_code)))->where('is_otp_varified', '=', 1)->count();

		if (isset($userCheck) && $userCheck > 0) {
			$userData = MainUser::where('mobile_number', $request->mobile_no)->where('country_code', urlencode(trim($request->country_code)))->where('is_otp_varified', '=', 1)->first();

			if ($userData->status == 0) {
				$result['code']     = (string) -3;
				$result['message']  = 'inactive_account';
				$result['result']   = [];
			} else if ($userData->status == 2) {
				$result['code']     = (string) -2;
				$result['message']  = 'account_deleted_contact_to_admin';
				$result['result']   = [];
			} else {
				// $password = Str::random(10);
				// $stuuserDataduserDataent->update(['password' => Hash::make($password)]);

				$otp_send = 0;
				$otp = $this->generateOTP();
				$post = [];
				$post['otp'] = $otp;
				$otp_send = $this->sendOtp($request->mobile_no, $request->country_code, $post['otp']);
				$post['otp_expire_time'] = date('Y-m-d H:i:s', strtotime(Helper::getOtpExpireTime()));

				$userData->update($post);

				$user_arr = [];
				$user_arr['user_id']      = (string) $userData->id;
				$user_arr['full_name']    = urldecode($userData->full_name);
				$user_arr['email']        = @urldecode($userData->email) ?: "";
				$user_arr['mobile_no']    = (string) $userData->mobile_number;
				$user_arr['otp']          = (string) $userData->otp;
				$user_arr['country_code'] = (string) @urldecode($userData->country_code) ?: "";
				$user_arr['user_type']    = (string) $userData->user_type;
				$user_arr['agent_type']   = (string) @$userData->agent_type ?: "";

				$user_arr['otp_expiration_date_time'] = (string) $userData->otp_expire_time;

				$startTime = Carbon::parse(date('Y-m-d H:i:s'));
				$finishTime = Carbon::parse($userData->otp_expire_time);
				$totalDuration = $finishTime->diffInSeconds($startTime);

				$user_arr['otp_expiration_time'] = (string) $totalDuration;

				// $profile_image = "";
				// if (@$userData->profile_image) {
				// 	$profile_image = asset('uploads/general_users/' . $userData->profile_image);
				// }
				// $user_arr['profile_image'] = $profile_image;
				$user_arr['token'] = (string) $userData->remember_token;

				$result['code']     = (string) 1;
				$result['message']  = 'otp_sent_to_this_number';
				$result['result'][] = $user_arr;
			}
		} else {
			$result['code']     =   (string) -5;
			$result['message']  =   'mobile_not_register_with_system.';
			$result['result']   = [];
		}

		$mainResult[] = $result;
		return response()->json($mainResult);
	}



	public function reset_password(Request $request)
	{
		$user_id = $request->input('user_id');
		$new_password = $request->input('password');

		$user = MainUser::where('id', $user_id)->where('status', '!=', 2)->where('is_otp_varified', '=', 1)->first();

		if ($user) {

			if ($user->status == 0) {
				$result['code']     = (string) -3;
				$result['message']  = 'inactive_account';
				$result['result']   = [];

				$mainResult[] = $result;
				return response()->json($mainResult);
			} else if ($user->status == 2) {
				$result['code']     = (string) -2;
				$result['message']  = 'account_deleted_contact_to_admin';
				$result['result']   = [];

				$mainResult[] = $result;
				return response()->json($mainResult);
			}

			if ($new_password) {

				$checkOld = Hash::check($request->input('password'), $user->password);

				if ($checkOld) {
					$result['code']     = (string) -8;
					$result['message']  = 'you_have_entered_old_password';
					$result['result']   = [];

					$mainResult[] = $result;
					return response()->json($mainResult);
				}

				$user->update(['password' => Hash::make($new_password)]);

				$user_arr = [];
				$user_arr['user_id']       = (string) $user->id;
				$user_arr['full_name']     = urldecode($user->full_name);
				$user_arr['email']         = @urldecode($user->email) ?: "";
				$user_arr['mobile_no']     = (string) $user->mobile_number;
				$user_arr['country_code']  = (string) @urldecode($user->country_code) ?: "";
				$user_arr['user_type']     = (string) $user->user_type;
				$user_arr['agent_type']    = (string) @$user->agent_type ?: "";
				$user_arr['about_user']    = (string) @$user->about_user ?: "";
				$user_arr['short_address'] = (string) @$user->user_short_address ?: "";

				$profile_image = "";
				if (@$user->profile_image) {
					$profile_image = asset('uploads/general_users/' . $user->profile_image);
				}

				$user_arr['profile_image'] = $profile_image;
				$user_arr['token'] = (string) $user->remember_token;

				$result['code']     = (string) 1;
				$result['message']  = 'password_reset_success';
				$result['result'][] = $user_arr;
			} else {
				$result['code']     = (string) 0;
				$result['message']  = 'failure';
				$result['result']   = [];
			}
		} else {
			$result['code']     =   (string) -7;
			$result['message']  =   'account_not_exists';
			$result['result']   =   [];
		}
		$mainResult[] = $result;
		return response()->json($mainResult);
	}



	/* 
	============================================= 
    | Some testings and common functions
	============================================= 
	*/

	public function testEmail()
	{
		$this->attachment_email(1, 'svapnil@mailinator.com', 'svapnil', '', '', 1);
	}

	//mail
	public function attachment_email($language_id, $email, $name, $url, $logo, $id)
	{

		$setting = Setting::find(1);
		// dd($setting);
		$templateData = Helper::getEmailTemplateData($language_id, $id);
		// dd($templateData);

		$from_email = $setting['from_email'];
		$data = array('email' => $email, 'name' => $name, 'url' => $url, 'id' =>  $id, 'logo' => $logo, 'from_email' => $from_email);
		// try {
		Mail::send('emails.registration', $data, function ($message) use ($data, $templateData) {
			$message->to($data['email'], $templateData->title)->subject($templateData->subject);
			$message->from($data['from_email'], 'DOM - Properties');
		});
		// } catch (\Throwable $th) {
		// 	// throw $th;
		// }
	}

	public function generateToken()
	{
		return md5(rand(1, 10) . microtime());
	}

	public function generateOTP()
	{
		return rand(1000, 9999);
	}


	/*
	==================================================================================
	|
	|   USER CHAT/CONVERSATION  
	|
	==================================================================================
	*/


	public function user_chat_list(Request $request)
	{
		$user_id = $request->input('user_id');
        $language_id = @$request->input('language_id') ?: 1;
		$page_no = @$request->input('page_no') ?: 1;

		$chat_list = UserConversation::from('user_conversation as m1')
			->select('m1.*')
			->join(DB::raw(
				'(
                SELECT
                    LEAST(from_id, to_id) AS from_id,
                    GREATEST(from_id, to_id) AS to_id,
                    MAX(id) AS max_id
                FROM user_conversation 
                GROUP BY
                    LEAST(from_id, to_id),
                    GREATEST(from_id, to_id)
            ) AS m2'
			), fn ($join) => $join
				->on(DB::raw('LEAST(m1.from_id, m1.to_id)'), '=', 'm2.from_id')
				->on(DB::raw('GREATEST(m1.from_id, m1.to_id)'), '=', 'm2.to_id')
				->on('m1.id', '=', 'm2.max_id'))
			->where('m1.from_id', $user_id)
			->orWhere('m1.to_id', $user_id)
			->orderByDesc('m1.created_at', 'desc');
			// ->take($this->chat_per_page)
			// ->skip( (($page_no * $this->chat_per_page) - 1) )
			// ->get();
		
		$total_records = $chat_list->count();
		$chat_list = $chat_list->paginate($this->chat_per_page, ['*'], 'page', $page_no);
		
		if($chat_list) {
			$chat_arr = [];
			foreach($chat_list as $key => $value) {
				$chat_data = [];
				$chat_user_id = "";
				if($value->from_id == $user_id) {
					$chat_user_id = $value->to_id;
					$chat_user_detail = $value->receiverDetails;
				}else {
					$chat_user_id = $value->from_id;
					$chat_user_detail = $value->senderDetails;
				}

				$profile_image = "";
				if (@$chat_user_detail->profile_image) {
					$profile_image = asset('uploads/general_users/' . $chat_user_detail->profile_image);
				}
				$user_arr['profile_image'] = $profile_image;

				$chat_data['user_id'] = (string) $user_id;
				$chat_data['chat_user_id'] = (string) $chat_user_id;
				$chat_data['sender_id'] =  (string) $value->from_id;
				$chat_data['receiver_id'] = (string) $value->to_id;
				$chat_data['name'] = urldecode($chat_user_detail->full_name);
				$chat_data['image'] = $profile_image;
				$chat_data['last_message'] = $value->message;

				$unread_count = 0;
				$unread_count = UserConversation::where('to_id', '=', $user_id)->where('read_status', '=', 0)->count();

				$chat_data['unread_message_counter'] = (string) $unread_count;
				$chat_data['date_time'] = date("H:i", strtotime($value->created_at));

				$chat_arr[] = $chat_data;
			}

			$response = [];
			$response['chat_list'] = $chat_arr;
			
			$result['code']     = (string) 1;
			$result['message']  = 'success';
			$result['total_records']  = (int) $total_records;
        	$result['per_page'] = (int) $this->messages_per_page;
			$result['result'][] = $response;
			$mainResult[] = $result;
			return response()->json($mainResult);
		}
		else {
			$result['code']     =   (string) -6;
			$result['message']  =   'no_data_found';
			$result['total_records']  = (int) $total_records;
        	$result['per_page'] = (int) $this->messages_per_page;
			$result['result']   =   [];
			$mainResult[] = $result;
			return response()->json($mainResult);
		}
			
	}

	/*
	==================================================================================
	|| USER CONVERSATION
	==================================================================================
	*/

	public function user_chat_messages(Request $request)
	{
		$user_id = $request->input('user_id');
		$chat_user_id = $request->input('chat_user_id');
        $language_id = @$request->input('language_id') ?: 1;
		$page_no = @$request->input('page_no') ?: 1;

		$chatData = UserConversation::where(function ($query) use ($user_id, $chat_user_id) {
			$query->where('from_id', '=', $user_id)
				  ->where('to_id', '=', $chat_user_id);
		})->orWhere(function ($query) use ($user_id, $chat_user_id) {
			$query->where('from_id', '=', $chat_user_id)
				  ->where('to_id', '=', $user_id);
		});

		$total_records = $chatData->count();

		$chatData = $chatData->latest()->paginate($this->messages_per_page, ['*'], 'page', $page_no);

		$chat = [];
		foreach ($chatData as $key => $value) {
			$message = [];
			$message['message_id'] = (string) ($value->id ?: "");
			$message['user_id'] = (string) ($user_id ?: "");
			$message['sender_id'] = (string) ($value->from_id ?: "");
			$message['receiver_id'] = (string) ($value->to_id ?: "");
			$message['message'] = (string) ($value->message ?: "");

			$messageTime = Helper::get_day_name($value->created_at);
			$message['message_time'] = $messageTime;
			$message['message_time_stamp'] = date('Y-m-d H:i:s', strtotime($value->created_at));

			$chat[] = $message;
		}

		$response = [];
		$response['chat_user_id'] = (string) $chat_user_id;
		$response['message_chat'] = $chat;
		
		$result['code']     = (string) 1;
		$result['message']  = 'success';
		$result['total_records']  = (int) $total_records;
        $result['per_page'] = (int) $this->messages_per_page;
		$result['result'][] = $response;
		
		$mainResult[] = $result;
		return response()->json($mainResult);
	}


	/*
	==================================================================================
	|| SEND MESSAGE
	==================================================================================
	*/

	public function send_message(Request $request) {
		$user_id = $request->input('user_id');
		$chat_user_id = $request->input('chat_user_id');
        $language_id = @$request->input('language_id') ?: 1;
		$message = $request->input('message');

		if($message) {
			$conversation = new UserConversation;
			$conversation->from_id = $user_id;
			$conversation->to_id   = $chat_user_id;
			$conversation->message = $message;
			$conversation->read_status = 0;

			if($conversation->save()) {

				$response = [];
				$response['message_id'] = (string) $conversation->id;
				$response['message'] = $conversation->message;
				$response['message_time'] = Helper::get_day_name($conversation->created_at);

				$result['code']     = (string) 1;
				$result['message']  = 'success';
				$result['result'][] = $response;
				
				$mainResult[] = $result;
				return response()->json($mainResult);
			}
			else{
				$result['code']     = (string) 0;
				$result['message']  = 'failure';
				$result['result']   = [];
				
				$mainResult[] = $result;
				return response()->json($mainResult);
			}
		}
		else{
			$result['code']     = (string) -5;
			$result['message']  = 'enter_message';
			$result['result']   = [];
			
			$mainResult[] = $result;
			return response()->json($mainResult);
		}
	}

	/*
	==================================================================================
	|
	|   USER PROFILE  
	|
	==================================================================================
	*/


	public function view_profile(Request $request) {
		$user_id = $request->input('user_id');
		$user_type = $request->input('user_type');
        $language_id = @$request->input('language_id') ?: 1;
		
		$user = MainUser::find($user_id);

		$response = [];
		$response['user_id'] = (string) $user_id;
		$response['full_name'] = urldecode($user->full_name) ?: "";
		$response['mobile_no'] = (string) $user->mobile_number ?: "";
		$response['email'] = urldecode($user->email) ?: "";
		$response['user_type'] = (string) $user->user_type;
		$response['agent_type'] = (string) $user->agent_type;
		$response['country_code'] = (string) urldecode($user->country_code) ?: "";
		$response['about_user'] = @$user->about_user ?: "";
		$response['short_address'] = @$user->user_short_address ?: "";

		$profile_image = "";
		if (@$user->profile_image) {
			$profile_image = asset( 'uploads/general_users/' . $user->profile_image );
		}

		$response['profile_image'] = $profile_image;

		
		$property_listing = [];
		
		if($user->user_type == config('constants.USER_TYPE_AGENT')) {
			$properties = Property::where('agent_id', '=', $user_id)->where('status', '=', 1)->where('property_subscription_enddate', '>=', date('Y-m-d H:i:s'))->paginate(5);
			foreach($properties as $key => $value) {
	
				$property_details = [];
				
				$is_fav = "0";
				if ($user_id) {
					$is_fav = UserFavouriteProperty::where('user_id', '=', $user_id)->where('property_id', '=', $value->id)->exists();
				}
	
				$area_name = "";
				$country_name = "";
				if ($value->area_id) {
					if ($language_id == 1) {
						$area_name = @urldecode($value->areaDetails->name) ?: "";
						$country_name = @urldecode($value->areaDetails->country->name) ?: "";
					} else {
						if (@$value->areaDetails->childdata[0]->name) {
							$area_name = urldecode($value->areaDetails->childdata[0]->name) ?: "";
						} else {
							$area_name = urldecode($value->areaDetails->name) ?: "";
						}
	
						if (@$value->areaDetails->country->childdata[0]->name) {
							$country_name = @urldecode($value->areaDetails->country->childdata[0]->name) ?: "";
						} else {
							$country_name = @urldecode($value->areaDetails->country->name) ?: "";
						}
					}
				}
	
				$short_address = ($area_name && $country_name) ? $area_name . ', ' . $country_name : "";
				$currency = @$value->areaDetails->country->currency_code ?: "KD";
	
				$property_image_url = PropertyImages::where('property_id', '=', $value->id)->orderBy('id', 'asc')->first();
	
				$image_url = "";
				if ($property_image_url) {
					$image_url = asset("storage/property_images/" . $value->id . '/' . $property_image_url->property_image);
				}
	
				$property_details['id'] = (string) $value->id;
				$property_details['property_id'] = (string) $value->property_id;
				$property_details['property_title'] = @$value->property_name ?: "";
				$property_details['property_image'] = $image_url;
				$property_details['property_price'] = (string) (@$value->price_area_wise ? (number_format(Helper::tofloat($value->price_area_wise), ($value->areaDetails->country->currency_decimal_point ?: 3))) : "0") . ' ' . $currency;
				$property_details['property_for'] =  @$value->property_for ? Helper::getLabelValueByKey(config('constants.PROPERTY_FOR.' . $value->property_for . '.label_key'), $language_id) : "";
				$property_details['property_for_id'] = (string) @$value->property_for ?: "";
	
				$property_details['is_favourite'] = (string) ($is_fav ?: "0");
				$property_details['property_short_address'] = $short_address;
	
				$property_listing[] = $property_details;
			}
		}

		$response['property_listing'] = $property_listing;

		$result['code']     = (string) 1;
		$result['message']  = 'success';
		$result['result'][] = $response;
		
		$mainResult[] = $result;
		return response()->json($mainResult);
	}


	public function edit_profile(Request $request)
	{
		$user_id = $request->input('user_id');
		$user_type = $request->input('user_type');
        $language_id = @$request->input('language_id') ?: 1;

		$post = $request->all();
		if ($post) {

			if (!empty($request->input('mobile_no'))) {
				$detail2 = $this->phoneExist($request->input('mobile_no'), $request->input('country_code'), $user_id);
				if ($detail2 > 0) {
					$result['code'] = (string) -4;
					$result['message'] = 'mobile_already_taken';
					$result['result'] = [];
					$mainResult[]   =   $result;
					return response()->json($mainResult);
				}
			}
			if (!empty($request->input('email'))) {
				$emailExists = $this->emailExist($request->input('email'), $user_id);
				if ($emailExists > 0) {
					$result['code'] = (string) -5;
					$result['message'] = 'email_already_taken';
					$result['result'] = [];
					$mainResult[]   =   $result;
					return response()->json($mainResult);
				}
			}

			$user = MainUser::find($user_id);

			$user->full_name = isset($request->full_name) ? urlencode($request->full_name) : "";
			$user->mobile_number = isset($request->mobile_no) ? $request->mobile_no : '';
			$user->email = isset($request->email) ? urlencode($request->email) : '';
			$user->country_code = isset($request->country_code) ? urlencode($request->country_code) : '';
			$user->about_user = isset($request->about_user) ? $request->about_user : '';
			$user->user_short_address = isset($request->short_address) ? $request->short_address : '';

			$formFileName = "profile_image";
        	$fileFinalName_ar = "";

			if ($request->$formFileName) {

				try {
					$image = $request->file($formFileName);
					$fileFinalName_ar = time(). '-' . rand(0,10000) .'.'.$image->getClientOriginalExtension();
					// $destinationPath = public_path( '/' . 'uploads/general_users/' );
					$pathImg =  public_path( 'uploads/general_users/' );
					//$request->file($formFileName)->move($destinationPath, $fileFinalName_ar);
					$request->file($formFileName)->move($pathImg, $fileFinalName_ar);
					// $img = Image::make($image->getRealPath());
					// $img->resize(500, null, function ($constraint) {
					//     $constraint->aspectRatio();
					// })->save($destinationPath , $fileFinalName_ar);
				} 
				catch (\Throwable $th) {
					// throw $th;
				}
	
	
			}
	
			if ($fileFinalName_ar != "") {
				// Delete a User file
				if ($user->profile_image != "") {
					\File::delete( asset('uploads/general_users/'. $user->profile_image));
				}
	
				$user->profile_image = $fileFinalName_ar;
			}


			// $otp_send = 0;
			// $otp = $this->generateOTP();
			// if (@$request->mobile_no && @$request->country_code) {
			// 	$post['otp'] = $otp;
			// 	$otp_send = $this->sendOtp($request->mobile_no, $request->country_code, $post['otp']);
			// 	$post['otp_expire_time'] = date('Y-m-d H:i:s', strtotime(Helper::getOtpExpireTime()));
			// } else {
			// 	$result['code']    = (string) 0;
			// 	$result['message'] = 'mobile_number_required';
			// 	$result['result']  = [];

			// 	$mainResult[] = $result;
			// 	return response()->json($mainResult);
			// }

			if ($user->save()) {

				$userData = [];
				$userData['user_id'] = (string) $user->id;
				$userData['full_name'] = @urldecode($user->full_name) ?: "";
				$userData['email'] = @urldecode($user->email) ?: "";
				$userData['mobile_no'] = (string) @$user->mobile_number ?: "";
				$userData['country_code'] = (string) @urldecode($user->country_code) ?: "";
				$userData['user_type'] = (string) $user->user_type;
				$userData['agent_type'] = (string) $user->agent_type;
				$userData['about_user'] = @$user->about_user ?: "";
				$userData['short_address'] = @$user->user_short_address ?: "";

				$profile_image = "";
				if (@$user->profile_image) {
					$profile_image = asset('uploads/general_users/' . $user->profile_image);
				}

				$userData['profile_image'] = $profile_image;
				$userData['token'] = (string) $user->remember_token;

				$result['code']     = (string) 1;
				$result['message']  = 'profile_updated_successfully';
				$result['result'][] = $userData;

			} else {
				$result['code']     = (string) 0;
				$result['message']  = 'something_wrong';
				$result['result']   = [];
			}
		} else {
			$result['code']     = (string) 0;
			$result['message']  = 'something_wrong';
			$result['result']   = [];
		}

		// $mainResult[]   =   $result;
		
		if ($request->input('is_testing') == 1) {
			// $result['result'] = $response;
			$mainResult = $result;
		} else {
			// $result['result'][] = $response;
			$mainResult[] = $result;
		}

		return response()->json($mainResult);
	}


	public function change_password(Request $request) {

		$user_id = $request->input('user_id');
		$new_password = $request->input('new_password');

		$user = MainUser::where('id', $user_id)->where('status', '=', 1)->where('is_otp_varified', '=', 1)->first();

		if ($user) {

			if ($new_password) {
				
				$oldMatch = Hash::check($request->input('old_password'), $user->password);
				if(!$oldMatch) {
					$result['code']     = (string) -8;
					$result['message']  = 'old_password_not_matched';

					$mainResult[] = $result;
					return response()->json($mainResult);
				}

				$checkOld = Hash::check($new_password, $user->password);
				if ($checkOld) {
					$result['code']     = (string) -8;
					$result['message']  = 'you_have_entered_old_password';

					$mainResult[] = $result;
					return response()->json($mainResult);
				}

				$user->update(['password' => Hash::make($new_password)]);

				$result['code']     = (string) 1;
				$result['message']  = 'password_changed_successfully';
			} else {
				$result['code']     = (string) 0;
				$result['message']  = 'new_password_required';
			}
		} else {
			$result['code']     =   (string) -7;
			$result['message']  =   'account_not_exists';
		}
		$mainResult[] = $result;
		return response()->json($mainResult);
	}

	public function favourite_list(Request $request) {
		$user_id = $request->input('user_id');
        $language_id = @$request->input('language_id') ?: 1;
		$page_no = $request->input('page_no') ?: 1;

		$favList = UserFavouriteProperty::whereHas('PropertyDetails', function ($property) {
				$property->where('status', '=', 1)->where('property_subscription_enddate', '>=', date('Y-m-d H:i:s'));
			})
			->whereHas('UserDetails', function ($agent) {
				$agent->where('status', '=', 1);
			})
			->where('user_id', '=', $user_id);
		
		$total_records = $favList->count();

		$favList = $favList->latest()->paginate($this->fav_property_per_page, ['*'], 'page', $page_no);
		
		$propertyArr = [];
		foreach($favList as $key => $property) {
			$propertyDetails = [];
			$propertyDetails['id'] = (string) $property->PropertyDetails->id;
			$propertyDetails['property_id'] = (string) $property->PropertyDetails->property_id;
			$propertyDetails['title'] =  @$property->PropertyDetails->property_name ?: "";

			$propertyDetails['property_for']  = @$property->PropertyDetails->property_for ? Helper::getLabelValueByKey(config('constants.PROPERTY_FOR.' . $property->PropertyDetails->property_for . '.label_key'), $language_id) : "";
            $propertyDetails['property_for_id']  = (string) (($property->PropertyDetails->property_for != "" && $property->PropertyDetails->property_for != null) ? $property->PropertyDetails->property_for : "");

			$currency = @$property->PropertyDetails->areaDetails->country->currency_code ?: "KD";

			$area_name = "";
            $country_name = "";
            if ($property->PropertyDetails->area_id) {
                if ($language_id == 1) {
                    $area_name = @urldecode($property->PropertyDetails->areaDetails->name) ?: "";
                    $country_name = @urldecode($property->PropertyDetails->areaDetails->country->name) ?: "";
                } else {
                    if (@$property->PropertyDetails->areaDetails->childdata[0]->name) {
                        $area_name = urldecode($property->PropertyDetails->areaDetails->childdata[0]->name) ?: "";
                    } else {
                        $area_name = urldecode($property->PropertyDetails->areaDetails->name) ?: "";
                    }

                    if (@$property->PropertyDetails->areaDetails->country->childdata[0]->name) {
                        $country_name = @urldecode($property->PropertyDetails->areaDetails->country->childdata[0]->name) ?: "";
                    } else {
                        $country_name = @urldecode($property->PropertyDetails->areaDetails->country->name) ?: "";
                    }
                }
            }

            $short_address = ($area_name && $country_name) ? $area_name . ', ' . $country_name : "";

			$image = @$property->PropertyDetails->propertyImages[0]->property_image ?: "";
			$property_image = "";
			if($image) {
				$property_image = asset("storage/property_images/" . $property->PropertyDetails->id . '/' . $image);
			}

			$property_price = (@$property->PropertyDetails->price_area_wise ? (number_format(Helper::tofloat($property->PropertyDetails->price_area_wise), ($property->PropertyDetails->areaDetails->country->currency_decimal_point ?: 3))) : "0") . ' ' . $currency;
			
			$propertyDetails['property_price'] = (string) $property_price;
			$propertyDetails['image_url'] = $property_image;
			$propertyDetails['bathroom_count'] =  @$property->PropertyDetails->property_name ?: "0";
            $propertyDetails['bedroom_count'] = (string) @$property->PropertyDetails->total_bedrooms ?: "0";
            $propertyDetails['toilet_count'] = (string) @$property->PropertyDetails->total_toilets ?: "0";
            $propertyDetails['area_sqft'] = (string) @$property->PropertyDetails->property_sqft_area ?: "0";
			$propertyDetails['latitude'] = (string) @$property->PropertyDetails->property_address_latitude ?: "";
            $propertyDetails['longitude'] = (string) @$property->PropertyDetails->property_address_longitude ?: "";

			$area_value = "";
            if ($property->PropertyDetails->areaDetails->updated_range > $property->PropertyDetails->areaDetails->default_range) {
                // green
                $area_value = 2;
            } else if ($property->PropertyDetails->areaDetails->updated_range < $property->PropertyDetails->areaDetails->default_range) {
                // red
                $area_value = 1;
            } else if ($property->PropertyDetails->areaDetails->updated_range == $property->PropertyDetails->areaDetails->default_range) {
                // yellow
                $area_value = 0;
            }

            $property_arr['area_value'] = (string) $area_value;

            $propertyDetails['area_value'] = (string) $area_value;
			$propertyDetails['is_fav'] = "1";
			$propertyDetails['is_featured'] = (string) ($property->is_featured ?: 0);
			$propertyDetails['short_address'] = $short_address;

			$propertyArr[] = $propertyDetails;
		}
		
		$response = ["property_list" => $propertyArr];

		$result['code']     = (string) 1;
        $result['message']  = "success";
        $result['total_records']  = (int) $total_records;
        $result['per_page'] = (int) $this->fav_property_per_page;
        $result['result'][] = $response;

        $mainResult[] = $result;
        return response()->json($mainResult);
	}

	public function my_ads(Request $request) {
		$user_id = $request->input('user_id');
        $language_id = @$request->input('language_id') ?: 1;
		$page_no = $request->input('page_no');

		$my_ads = Property::with('agentDetails')
			->where('status', '!=', 2)
			->where('agent_id', '=', $user_id);
			// ->where('property_subscription_enddate', '>=', date('Y-m-d H:i:s'));

		$total_records = $my_ads->count();

		$my_ads = $my_ads->latest()->paginate($this->my_ads_per_page, ['*'], 'page', $page_no);
		$property_list = [];

		foreach ($my_ads as $key => $property) {
			$property_arr = [];
            $property_arr['id']  = (string) $property->id;
            $property_arr['property_id']  = (string) @$property->property_id ?: "";
            $property_arr['title']  = @$property->property_name ?: "";
            $property_arr['property_for']  = @$property->property_for ? Helper::getLabelValueByKey(config('constants.PROPERTY_FOR.' . $property->property_for . '.label_key'), $language_id) : "";
            $property_arr['property_for_id']  = (string) (($property->property_for != "" && $property->property_for != null) ? $property->property_for : "");

            $area_name = "";
            $country_name = "";
            if ($property->area_id) {
                if ($language_id == 1) {
                    $area_name = @urldecode($property->areaDetails->name) ?: "";
                    $country_name = @urldecode($property->areaDetails->country->name) ?: "";
                } else {
                    if (@$property->areaDetails->childdata[0]->name) {
                        $area_name = urldecode($property->areaDetails->childdata[0]->name) ?: "";
                    } else {
                        $area_name = urldecode($property->areaDetails->name) ?: "";
                    }

                    if (@$property->areaDetails->country->childdata[0]->name) {
                        $country_name = @urldecode($property->areaDetails->country->childdata[0]->name) ?: "";
                    } else {
                        $country_name = @urldecode($property->areaDetails->country->name) ?: "";
                    }
                }
            }

            $short_address = ($area_name && $country_name) ? $area_name . ', ' . $country_name : "";
            $property_arr['short_address']  = $short_address;

            $currency = @$property->areaDetails->country->currency_code ?: "KD";
			
            $property_arr['property_price'] = (string) (@$property->base_price ? (number_format(Helper::tofloat($property->base_price), ($property->areaDetails->country->currency_decimal_point ?: 3))) : "0") . ' ' . $currency;
            $property_arr['bathroom_count'] = (string) @$property->total_bathrooms ?: "0";
            $property_arr['bedroom_count'] = (string) @$property->total_bedrooms ?: "0";
            $property_arr['toilet_count'] = (string) @$property->total_toilets ?: "0";
            $property_arr['area_sqft'] = (string) @$property->property_sqft_area ?: "0";

            $property_arr['latitude'] = (string) @$property->property_address_latitude ?: "";
            $property_arr['longitude'] = (string) @$property->property_address_longitude ?: "0";
            $property_arr['area_value'] = (string) @$property->areaDetails->updated_range ?: "";

            $property_image = "";
            if ($property->propertyImages->count() > 0) {
                $property_image = asset("storage/property_images/" . $property->id . '/' . $property->propertyImages[0]->property_image);
            }
            $property_arr['image_url'] = (string) $property_image;

            $is_fav = 0;
            if ($user_id) {
                $is_fav = UserFavouriteProperty::where('user_id', '=', $user_id)->where('property_id', '=', $property->id)->exists();
            }
            $property_arr['is_favourite'] = (string) $is_fav;
            $property_arr['is_featured'] = (string) ($property->is_featured ?: 0);

			$is_expired = 0;
			if($property->property_subscription_enddate <  date('Y-m-d H:i:s')) {
				$is_expired = 1;
			}
			$property_arr['is_plan_expired'] = (string) $is_expired;
			$property_arr['plan_expiry_date'] = date('Y-m-d', strtotime($property->property_subscription_enddate));

            $property_list[] = $property_arr;
		}

		$response = ["my_ads" => $property_list];

		$result['code']     = (string) 1;
        $result['message']  = "success";
        $result['total_records']  = (int) $total_records;
        $result['per_page'] = (int) $this->my_ads_per_page;
        $result['result'][] = $response;

        $mainResult[] = $result;
        return response()->json($mainResult);
	}


	public function report_user(Request $request) {
		$user_id = $request->input('user_id');
        $language_id = @$request->input('language_id') ?: 1;
		$agent_id = $request->input('agent_id');

		$mobile_no = $request->input('mobile_no');
		$email = $request->input('email');
		$full_name = $request->input('full_name');
		$country_code = $request->input('country_code');
		$message = $request->input('message');

		$setting = Setting::find(1);
		$admin_email = $setting->email;

		if($agent_id) {

			$report = new ReportUser;
			$report->uname = $full_name ?: "";
			$report->user_id = $user_id ?: "";
			$report->agent_id = $agent_id;
			$report->email = $email ?: "";
			$report->phone = $mobile_no ?: "";
			$report->country_code = $country_code ?: "";
			$report->report_message = $message ?: "";
	
			$report->save();
			$template_id = 5;
	
			$this->sendEmail($language_id, $admin_email, $email, $full_name, $mobile_no, $country_code, $message, $agent_id, "", "", $template_id);
	
			$result['code']     = (string) 1;
			$result['message']  = "user_reported";
		}
		else {
			$template_id = 9;
			$this->sendEmail($language_id, $admin_email, $email, $full_name, $mobile_no, $country_code, $message, "", "", "", $template_id);
	
			$result['code']     = (string) 1;
			$result['message']  = "mail_sent_to_admin";
		}

        $mainResult[] = $result;
        return response()->json($mainResult);
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



	// subscription plan details
    public function get_active_plan_details(Request $request) {
		$user_id = $request->input('user_id');
        $language_id = @$request->input('language_id') ?: 1;

		$planDetails = UserSubscription::with(['propertiesSubscribed' => function ($properties) {
			$properties->where('status', '!=', 2)->where('property_subscription_enddate', '>=', date('Y-m-d H:i:s'));
		}])
		->where('user_id', '=', $user_id)
		->where('end_date', '>=', date('Y-m-d H:i:s'))
		->latest('id')
		->first();
		
		$plan = [];
		if($planDetails) {
			$plan['plan_id'] = (string) $planDetails->plan_id;
			$plan['plan_price'] = (string) $planDetails->total_price;
			$subPlanData = $planDetails->subscriptionPlanDetails;
			// dd($subPlanData);
			$plan['plan_name'] = ($language_id == 2 && $planDetails->plan_name_ar) ? $planDetails->plan_name_ar : $planDetails->plan_name;
			$plan['plan_description'] = ($language_id ==2 && $planDetails->plan_description_ar) ? $planDetails->plan_description_ar : $planDetails->plan_description;

			$plan_duration = "-";
            if($planDetails->plan_duration_value && $planDetails->plan_duration_type){
                $plan_duration = Helper::getValidTillDate( date('Y-m-d H:i:s'), $planDetails->plan_duration_value ,$planDetails->plan_duration_type);
            }

			$plan['plan_duration'] = ($plan_duration != '-') ? $plan_duration['value'] . " " . $plan_duration['label_value'] : "-";

			$plan_for = @$planDetails->plan_type!="" ? Helper::getLabelValueByKey(config('constants.AGENT_TYPE.'.$planDetails->plan_type.'.label_key')) : '-';

			$total_posts = $planDetails->no_of_plan_post?: 0;
			// $total_posts = (int) $total_posts + (int) ($planDetails->no_of_extra_featured_post ?: 0);
			$plan['number_of_total_ads'] = (string) $total_posts;
			$plan['subscription_type'] = "1";
			$plan['plan_for'] = $plan_for;
			$plan['plan_for_id'] = (string) (@$planDetails->plan_type ?: 1);
			$plan['is_free'] = (string) ($planDetails->is_free_plan ?: 0);
			$plan['start_date'] = (string) Carbon::parse($planDetails->start_date)->format('Y-m-d h:i A');
			$plan['end_date'] = (string) Carbon::parse($planDetails->end_date)->format('Y-m-d h:i A');
			$plan['total_ads_posted'] = (string) $planDetails->propertiesSubscribed->count();
			$plan['is_expired'] = (string) ((time() > strtotime($planDetails->end_date)) ? 1 : 0);
			$plan['is_featured'] = (string) ($planDetails->is_featured ?: 0);
			$plan['no_of_default_featured_post'] = (string) ($planDetails->no_of_default_featured_post ?: 0);
			$plan['no_of_extra_featured_post'] = (string) ($planDetails->no_of_extra_featured_post ?: 0);
			$plan['extra_each_normal_post_price'] = (string) ($planDetails->extra_each_normal_post_price ?: 0);
		}

		$featured_plan_detail = [];
		$userfeaturedaddon = UserFeaturedAddons::where('user_id', '=', $user_id)->latest()->first();

		if($userfeaturedaddon) {
			$featured_plan_detail['featured_plan_id'] = (string) $userfeaturedaddon->id;
			$featured_plan_detail['featured_plan_price'] = (string) number_format($userfeaturedaddon->price, 3);
			if($userfeaturedaddon->duration_value && $userfeaturedaddon->duration_type) {
				$duration = \Helper::getFeatuerdAddonsDuration($userfeaturedaddon->start_date, $userfeaturedaddon->duration_value, $userfeaturedaddon->duration_type);
			}
			$featured_plan_detail['featured_plan_duration'] = @$duration ? $duration['print'] : "";

			$is_expired = 0;
			if($userfeaturedaddon->end_date > date('Y-m-d H:i:s')) {
				$is_expired = 1;
			}

			$featured_plan_detail['is_expired'] = @($userfeaturedaddon->end_date > date('Y-m-d H:i:s')) ? "1" : "0";
		}

		$planResult = [];
		if($plan) {
			$planResult[] = $plan;
		}

		$featuredplanResult = [];
		if($featured_plan_detail) {
			$featuredplanResult[] = $featured_plan_detail;
		}
		
		$result['code']     = (string) 1;
		$result['message']  = "success";
		$result['result'][] = ['plan_detail' => $planResult, 'featured_plan_detail' => $featuredplanResult];

		$mainResult[] = $result;
        return response()->json($mainResult);
    }



}
