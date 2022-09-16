<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Label;
use App\Models\MainUsers as MainUser;
use App\Models\Property;
use App\Models\Amenity;
use App\Models\Cms;
use App\Models\FeaturedAddons;
use App\Models\SubscriptionPlan;
use App\Models\UserSubscription;
use Helper;
use DB;

class SettingsController extends Controller
{
    // labels
    public function label(Request $request)
    {
        $result = [];
        $labels = [];
        $language_id = isset($request->language_id) ? $request->language_id : 1;

        if (!empty($request->input('updated_date'))) {
            $labelList = Label::where('parentid', '=', 0)
                ->where(function ($q) use ($request, $language_id) {
                    $q->where('updated_at', '>=', $request->input('updated_date'))
                        ->orWhere(function ($child) use ($request, $language_id) {
                            $child->whereHas('childdata', function ($childData) use ($request, $language_id) {
                                $childData->where('updated_at', '>=', $request->input('updated_date'))->where('language_id', '=', $language_id);
                            });
                        });
                })->with('childdata')->get();
        } else {
            $labelList  =   Label::with('childdata')->where([
                ['status', '=', '1'],
                ['parentid', '=', 0]
            ])->get();
        }

        $label_arr = [];
        foreach ($labelList as $lkey => $lvalue) {
            if ($language_id != 1) {
                foreach ($lvalue->childdata as $k => $v) {
                    if ($language_id == $v->language_id) {
                        $labels['key']   = $v['labelname'];
                        $labels['value'] = $v['labelvalue'];

                        $label_arr[] = $labels;
                    }
                }
            } else {
                $labels['key']   = $lvalue['labelname'];
                $labels['value'] = $lvalue['labelvalue'];

                $label_arr[] = $labels;
            }
        }

        if (!empty($labelList) && count($labelList) > 0) {
            $labelArr = $label_arr;
            $result['code']          = (string) 1;
            $result['message']       = 'success';
            $result['updated_date']  = date('Y-m-d H:i');
            $result['result']        = $labelArr;
        } else {
            $result['code']          = (string) 0;
            $result['message']       = 'no_data_is_available';
            $result['updated_date']  = date('Y-m-d H:i');
            $result['result']        = [];
        }
        $mainResult[] = $result;

        return response()->json($mainResult);
    }


    public function general(Request $request)
    {
        // if(@$request->token && @$request->user_id){
        //     $check = MainUsers::where('remember_token','=',$request->token)->find($request->user_id);
        //     if(!@$check){
        //         $result['code']          = 0;
        //         $result['message']       = 'inactive_account';
        //         $result['updated_date']  = date('Y-m-d H:i');
        //         return response()->json($result);
        //     }
        // }
        $logout_label_keys = [];
        $logout_label_keys['logout_label_key'] = array(
            "inactive_account",
            "server_not_responding",
            "account_delete_contact_to_admin",
        );
        $logout_label_keys['max_image_upload_limit'] = (string) Helper::getMaxImagesUploadLimit();

        $result['code']          = (string) 1;
        $result['message']       = 'success';
        $result['result'][]      = $logout_label_keys;

        $mainResult[] = $result;
        return response()->json($mainResult);
    }

    public function amenities(Request $request)
    {
        $user_id = $request->input('user_id');
        $language_id = $request->input('language_id', 1);
        $token = $request->input('token');

        if ($user_id) {
            $user = MainUser::where('id', $user_id)->where('is_otp_varified', '=', 1)->first();

            if ($user) {

                if ($user->status == 0) {
                    $result['code']     = (string) -3;
                    $result['message']  = 'inactive_account';
                    $result['result']   = [];

                    $mainResult[] = $result;
                    return response()->json($mainResult);
                }

                if ($user->status == 2) {
                    $result['code']     = (string) -2;
                    $result['message']  = 'account_deleted_contact_to_admin';
                    $result['result']   = [];

                    $mainResult[] = $result;
                    return response()->json($mainResult);
                }

                // if($user->remember_token != $token){
                // 	$result['code']     = (string) -7;
                // 	$result['message']  = 'invalid_token';
                // 	$result['result']   = [];

                // 	$mainResult[]=$result;
                // 	return response()->json($mainResult); 
                // }
            } else {
                $result['code']     = (string) -7;
                $result['message']  = 'account_not_found';
                $result['result']   = [];

                $mainResult[] = $result;
                return response()->json($mainResult);
            }
        } // if user id END

        $amenities = Amenity::with(['childdata' => function ($childData) use($language_id) {
                $childData->where('language_id', '=', $language_id);
            }])
            ->where('parent_id', '=', 0)
            ->where('status', '=', 1)
            ->get();

        $amenity_arr = [];
        foreach($amenities as $key => $value){
            $data = [];
            $data['id'] = (string) $value->id;
            $amenity_name = $value->amenity_name;
            if ($language_id > 1) {
                $amenity_name = @$value->childdata[0]->amenity_name ?: $value->amenity_name;
            }
            $data['amenities_title'] = (string) urldecode($amenity_name);

            $amenity_arr[]  = $data;
        }

        $result['code']     = (string) 1;
        $result['message']  = 'success';
        $result['result'][] = array("amenities" => $amenity_arr);

        $mainResult[] = $result;
        return response()->json($mainResult);
    }


    public function cms_page(Request $request)
    {
        $user_id = $request->input('user_id');
        $language_id = $request->input('language_id', 1);
        $cms_id = $request->input('cms_id');

        if ($user_id) {
            $user = MainUser::where('id', $user_id)->where('is_otp_varified', '=', 1)->first();

            if ($user) {

                if ($user->status == 0) {
                    $result['code']     = (string) -3;
                    $result['message']  = 'inactive_account';
                    $result['result']   = [];

                    $mainResult[] = $result;
                    return response()->json($mainResult);
                }

                if ($user->status == 2) {
                    $result['code']     = (string) -2;
                    $result['message']  = 'account_deleted_contact_to_admin';
                    $result['result']   = [];

                    $mainResult[] = $result;
                    return response()->json($mainResult);
                }

                // if($user->remember_token != $token){
                // 	$result['code']     = (string) -7;
                // 	$result['message']  = 'invalid_token';
                // 	$result['result']   = [];

                // 	$mainResult[]=$result;
                // 	return response()->json($mainResult); 
                // }
            } else {
                $result['code']     = (string) -7;
                $result['message']  = 'account_not_found';
                $result['result']   = [];

                $mainResult[] = $result;
                return response()->json($mainResult);
            }
        } // if user id END

        $cms_data = Cms::with(['childdata' => function ($childQuery) use($language_id) {
                        $childQuery->where('language_id', '=', $language_id);
                    }])
                    ->where('parentid', '=', 0)
                    ->where('status', '=', 1)
                    ->find($cms_id);
        
        if(@$cms_data) {
            $cmsDetails = [];
            $page_title = @$cms_data->page_name ?: "";
            $page_description = @$cms_data->description ?: "";
    
            if ($language_id > 1) {
                $page_title = @$cms_data->childdata[0]->page_name ?: $cms_data->page_name;
                $page_description = @$cms_data->childdata[0]->description ?: $cms_data->description;
            }
    
            $cmsDetails['id'] = (string) $cms_data->id;
            $cmsDetails['cms_title'] = $page_title;
            $cmsDetails['cmd_description'] = $page_description;
    
            $result['code']     = (string) 1;
            $result['message']  = 'success';
            $result['result'][] = $cmsDetails;
    
            $mainResult[] = $result;
            return response()->json($mainResult);
        }
        else{
            $result['code']     = (string) -7;
            $result['message']  = 'no_data_found';
            $result['result']   = [];

            $mainResult[] = $result;
            return response()->json($mainResult);
        }
    }
    
    public function subscription_plan_listing(Request $request) {
        $user_id = $request->input('user_id');
        $language_id = $request->input('language_id', 1);
        $plan_type = $request->input('plan_type'); // 1-property_wise, 2 - subscription_wise/plan_wise
        $plan_for = $request->input('plan_for') ?: 1; // 1-individual, 2 - company

        $plans = SubscriptionPlan::with(['childdata' => function ($child) use($language_id) {
                $child->where('language_id', '=', $language_id);
            }])
            ->where('parent_id', '=', 0)
            // ->where('subscription_type', '=', $plan_type)
            ->where('plan_type', '=', $plan_for)
            ->where('status', '=', 1)
            ->get();
        
        $plan_list = [];
        foreach ($plans as $key => $value) {
            $planDetails = [];
            if($language_id != 1) {
                $plan_name = @$value->childdata[0]->plan_name ?: $value->plan_name;
                $plan_description = @$value->childdata[0]->plan_description ?: $value->plan_description;
            } else{
                $plan_name = $value->plan_name;
                $plan_description = $value->plan_description;
            }

            $plan_duration_data = [];
            if($value->plan_duration_value && $value->plan_duration_type){
                $plan_duration_data = Helper::getValidTillDate( date('Y-m-d H:i:s'), $value->plan_duration_value ,$value->plan_duration_type);
            }

            $plan_duration = $plan_duration_data['value'] . ' ' . $plan_duration_data['label_value'];

            $planDetails['plan_id'] = (string) $value->id;
            $planDetails['plan_price'] = (string) number_format(Helper::toFloat($value->plan_price), 2, '.', '');
            $planDetails['plan_name'] = $plan_name;
            $planDetails['plan_description'] = $plan_description;
            $planDetails['plan_duration'] = (string) $plan_duration;
            $planDetails['number_of_ads'] = (string) $value->no_of_plan_post;
            $planDetails['extra_each_normal_post_price'] = (string) @$value->extra_each_normal_post_price;
            $planDetails['is_featured'] = (string) (@$value->is_featured ?: 0);
            $planDetails['is_free_plan'] = (string) (@$value->is_free_plan ?: 0);
            $planDetails['no_of_default_featured_post'] = (string) (@$value->no_of_default_featured_post ?: 0);

            $plan_list[] = $planDetails;
        }

        $add_ons = [];
        $featuredAddons = FeaturedAddons::where('status', '=', 1)->get();
        foreach($featuredAddons as $key => $value) {
            $arr = [];
            $arr['id'] = (string) $value->id;
            $arr['no_of_extra_featured_post'] = (string) (@$value->no_of_extra_featured_post ?: 0);
            $arr['extra_each_featured_post_price'] = (string) (@$value->extra_each_featured_post_price ?: 0);

            $add_ons[] = $arr;
        }
        $result['code']     = (string) 1;
        $result['message']  = 'success';
        $result['result'][] = ["plan_list" => $plan_list, "add_ons" => $add_ons];

        $mainResult[] = $result;
        return response()->json($mainResult);
    }

    public function featured_addons_list(Request $request) {
        $user_id = $request->input('user_id');
        $language_id = $request->input('language_id', 1);
        $plans = FeaturedAddons::where('status', '=', 1)->get();
        
        $plan_list = [];
        foreach ($plans as $key => $value) {
            $featured_plan_detail = [];

            $featured_plan_detail['featured_plan_id'] = (string) $value->id;
			$featured_plan_detail['featured_plan_price'] = (string) number_format($value->extra_each_featured_post_price, 3);
            if($value->duration_value && $value->duration_type) {
                $duration = \Helper::getFeatuerdAddonsDuration($value->start_date, $value->duration_value, $value->duration_type);
            }
			$featured_plan_detail['featured_plan_duration'] = @$duration ? $duration['print'] : "";

			$is_expired = 0;
			if($value->end_date > date('Y-m-d H:i:s')) {
				$is_expired = 1;
			}

			$featured_plan_detail['is_expired'] = @($value->end_date > date('Y-m-d H:i:s')) ? "1" : "0";

            $plan_list[] = $featured_plan_detail;
        }

        $result['code']     = (string) 1;
        $result['message']  = 'success';
        $result['result'][] = ["plan_list" => $plan_list];

        $mainResult[] = $result;
        return response()->json($mainResult);
    }

    public function subscription_list(Request $request) {
        $language_id = $request->input('language_id');
        $user_id = $request->input('user_id');

        $subscription_plans = UserSubscription::with(['propertiesSubscribed' => function ($properties) {
            return $properties->where('status', '!=', 2);
        }])
        ->where('user_id', '=', $user_id)
        ->where('status', '!=', 2)
        ->orderBy('id', 'desc')
        ->get();

        $usersubscriptions = [];
        foreach($subscription_plans as $key => $data) {

            $usersubscriptions['id'] = (string) $data->id;
            $usersubscriptions['plan_name'] = ($language_id != 1 && @$data->plan_name_ar) ? $data->plan_name_ar : $data->plan_name;
            $usersubscriptions['plan_description'] = ($language_id != 1 && @$data->plan_description_ar) ? $data->plan_description_ar : $data->plan_description;
            $usersubscriptions['plan_type'] = ($language_id != 1 && @$data->plan_description_ar) ? $data->plan_description_ar : $data->plan_description;

        }

    }

    public function cancel_plan(Request $request) {
        $language_id = Helper::currentLanguage()->id;
        $labels = Helper::LabelList($language_id);
        $user_id = \Auth::guard('web')->id();

        $usersubid = $request->input('plan_id');
        if($usersubid) {

            $user_sub = UserSubscription::find($usersubid);
            $user_sub->status = 2;
            $user_sub->save();

            $mainResult['statusCode'] = 200;
            $mainResult['message'] = $labels['plan_cancelled_successfully'];
            $mainResult['url'] = "";
            $mainResult['title'] = $labels['plan_cancelled_successfully'];
            return response()->json($mainResult);
        } 
        else {
            $mainResult['statusCode'] = 201;
            $mainResult['message'] = $labels['something_went_wrong'];
            $mainResult['url'] = "";
            $mainResult['title'] = $labels['something_went_wrong'];
            return response()->json($mainResult);
        }

    }



}
