<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WebmasterSection;
use Auth;
use File;
use Illuminate\Support\Facades\DB;
use Illuminate\Config;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Models\MainUsers;
use Redirect;
use Helper;
use Hash;
use Image;
use Illuminate\Validation\Rule; 
use Illuminate\Support\Carbon;
use App\Models\Setting;
use App\Models\BusinessOwner;
use App\Models\BusinessOwnerType;
use App\Models\Language;

class BusinessOwnerController extends Controller
{
    // Define Default Variables
    private $uploadPath = "/uploads/general_users/";
    protected $image_uri = "";
    protected $no_image = "";

    public function __construct()
    {
        $this->middleware('auth');
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $businessOwner_type_text = "")
    {
        $businessOwner_type = [];
        $businessOwner_type['businessOwner_type'] = $businessOwner_type_text;
        $businessOwner_type['businessOwner_list'] = MainUsers::where('status','!=',"2")
        ->where('user_type','=',"1")
        ->with(['businessOwnerType' => function ($q){
            $q->where('status', '!=', "2");
        }])->get()->toArray();
        return view("dashboard.businessOnwers.list", $businessOwner_type);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MainUsers  $user
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $businessOwner_types_list['businessOwner_types'] =  BusinessOwnerType::where('status',"1")->get();
        return view("dashboard.businessOnwers.create",$businessOwner_types_list);
    }

    public function store(Request $request)
    {
        $main_user = new MainUsers();
        $this->validate($request, [
            'full_name' => 'required', 
            'email' => 'required',  
            'mobile_number' => 'required',  
            'username' => 'required|string|regex:/\w*$/|max:255|unique:users,username',  
        ]);
        $main_user->full_name = @$request->full_name?:"";
        $main_user->email = @$request->email?:"";
        $main_user->username = @$request->username?:"";
        $main_user->user_type = "1";
        $main_user->business_type_id =  @$request->businessowner_type?:1;
        $main_user->country_code = urlencode($request->country_code);
        $main_user->mobile_number = @$request->mobile_number?: urlencode($request->mobile_number);
        
        $formFileName = "photo";
        $fileFinalName_ar = "";

        if ($request->photo != "") {
            $newname = $_FILES[$formFileName]['name'];
            $ext = pathinfo($newname, PATHINFO_EXTENSION);
            $insertimage = 'users-'.time().'.'.$ext; 
            $tmpfile = $_FILES[$formFileName]['tmp_name'];
            $upload_dir =  public_path()."/" . $this->getUploadPath();

            if (!file_exists($upload_dir)) {
              \File::makeDirectory($upload_dir, 0777, true);
            }
            move_uploaded_file($tmpfile, $upload_dir.$insertimage);
            $source_imagebanner = $upload_dir.$insertimage;
            $file_namebanner= "users-".time().'-'.str_pad(rand(0,1000), 4, '0', STR_PAD_LEFT).".".$ext;
            $image_destinationbanner = $upload_dir.$file_namebanner;
            Helper::correctImageOrientation($source_imagebanner);
            $compress_images = Helper::compressImage($source_imagebanner, $image_destinationbanner);
            Helper::correctImageOrientation($image_destinationbanner);
            unlink($source_imagebanner);
            $fileFinalName_ar=$file_namebanner;

            if (!file_exists($upload_dir)) {
              \File::makeDirectory($upload_dir, 0775, true);
            }
        }
        $main_user->profile_image = $fileFinalName_ar;
        $main_user->save();

        return redirect()->route('businessOwners')->with('success', __('backend.addDone'));
    }

    public function show($id)
    {
        $id = decrypt($id);
        $user = MainUsers::with(['businessOwnerType'])->find($id);
        // echo '<pre>';
        // print_r($user['businessOwnerType']);
        // exit;
        $image_url = $this->image_uri;
        return view('dashboard.businessOnwers.show', compact('user','image_url'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = decrypt($id);
        $user = MainUsers::find($id);
        $image_url = $this->image_uri;
        $businessOwner_types =  BusinessOwnerType::where('status',"1")->get();
        if($user){
            return view('dashboard.businessOnwers.edit', compact('user', 'image_url','businessOwner_types'));
        }else{
            return redirect()->route('businessOnwers')->with('errorMessage', __('backend.noDataFound'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'full_name' => 'required', 
            'email' => 'required',  
            'mobile_number' => 'required',  
            'username' => 'string|regex:/\w*$/|max:255|unique:users,username,'.$id.',id',  
        ]);

        $user = MainUsers::find($id);

        $formFileName = "photo";
        $fileFinalName_ar = "";

        if ($request->photo_delete == 1) {
            if ($user->profile_image != "") {
                File::delete($this->getUploadPath() . $user->profile_image);
            }

            $user->profile_image = "";
        }

        if ($request->photo != "") {
            $newname = $_FILES[$formFileName]['name'];
            $ext = pathinfo($newname, PATHINFO_EXTENSION);
            $insertimage = 'users-'.time().'.'.$ext; 
            $tmpfile = $_FILES[$formFileName]['tmp_name'];
            $upload_dir =  public_path()."/" . $this->getUploadPath();

            if (!file_exists($upload_dir)) {
              \File::makeDirectory($upload_dir, 0777, true);
            }
            move_uploaded_file($tmpfile, $upload_dir.$insertimage);
            $source_imagebanner = $upload_dir.$insertimage;
            $file_namebanner= "users-".time().'-'.str_pad(rand(0,1000), 4, '0', STR_PAD_LEFT).".".$ext;
            $image_destinationbanner = $upload_dir.$file_namebanner;
            Helper::correctImageOrientation($source_imagebanner);
            $compress_images = Helper::compressImage($source_imagebanner, $image_destinationbanner);
            Helper::correctImageOrientation($image_destinationbanner);
            unlink($source_imagebanner);
            $fileFinalName_ar=$file_namebanner;

            if (!file_exists($upload_dir)) {
              \File::makeDirectory($upload_dir, 0775, true);
            }
        }

        $user->full_name = urlencode($request->full_name);
        $user->email = urlencode($request->email);
        $user->username = urlencode($request->username);
        $user->country_code = urlencode($request->country_code);
        $user->mobile_number = urlencode($request->mobile_number);
        $user->profile_image = ($fileFinalName_ar != '') ? $fileFinalName_ar : $user->profile_image;
        $user->save(); 

        return redirect()->route('businessOwners')->with('success', __('backend.saveDone'));
    }


    public function validateRequest($request,$id="",$lang_id = "",$childId="")
    {
        $validation_messages = [
            'full_name.required' => 'Full Name is required.',
            'full_name.string' => 'Only string allowed',
            'full_name.max' => 'Max length exceeded',
            'mobile_number.unique' => 'Mobile Number is already taken.',
            'email.encoded_unique' => 'Email is already taken.',
            'photo.mimes' => 'Not valid image extension',
            'photo.max' => 'Size is not valid',
            'photo.image' => 'Not good image',
        ];

        if( $id !="" )
        {
            $validator = Validator::make($request->all(), [
                'full_name' => [
                                    'required',
                                    'string',
                                    'max:100',
                                ],
                'email' => [
                            'required',
                            'encoded_unique:users,email,id,'.$id.',status,2',
                        ],
                'country_code' => [
                                    'required'
                                ],
                'mobile_number' => [ 
                                    'required',
                                    Rule::unique('App\Models\MainUsers','mobile_number')->ignore($id)->where(function ($query) use($request) {
                                        return $query->where('status', "!=", 2)->where('country_code','=',urlencode($request->country_code));
                                    }),
                                    // 'unique:App\Models\MainUsers,mobile_number,status,2,id'
                                    // 'unique:users,mobile_number,status,2',
                                    
                                ],
                // 'photo' => 'mimes:jpeg,jpg,png,gif',
            ],
            $validation_messages
        );

        }
         else{
            $validator = Validator::make($request->all(), [
                'full_name' => [
                                    'required',
                                    'string',
                                    'max:100',
                                ],
                'email' => [ 
                            'required',
                            'email',
                            'encoded_unique:users,email,status,2'
                        ],
                'mobile_number' => [ 
                                    'required',
                                    'unique:App\Models\MainUsers,mobile_number,status,2'
                                ],
                'photo' => 'image|mimes:jpeg,jpg,png,gif',
            ],
            $validation_messages
        );
        }

        return $validator;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = decrypt($id);
        $user = MainUsers::find($id);

        if ($user->profile_image != "") {
            File::delete($this->getUploadPath() . $user->profile_image);
        }
        $user->profile_image = null;
        $user->status = 2;
        $user->save();
        
        return redirect()->route('businessOwners')
            ->with('success', __('backend.deleteDone'));
    }

    /* 
    *
    * AJAX call server side pagination
    *
    */

    public function anyData(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");
        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');
        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = '';
        $agent_type = $request->get('agent_type');

        if (isset($order_arr[0]['dir']) && $order_arr[0]['dir'] != "") {
            $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        }
        $searchValue = $search_arr['value']; // Search value

        if ($columnIndex == 1) {
            $sort = 'users.full_name';
        }
        if ($columnIndex == 2) {
            $sort = 'users.profile_photo';
        } 
        elseif($columnIndex==3){
            $sort = 'users.email';
        }
        elseif ($columnIndex==4) {
            $sort = 'users.mobile_number';
        }
        elseif ($columnIndex==6) {
            $sort = 'users.created_at';
        } 
        else {
            $sort = 'users.id';
        }

        $sortBy = 'DESC';
        if ($columnSortOrder != "") {
            $sortBy = $columnSortOrder;
        }

        $totalAr = MainUsers::where('status','!=',"2")
        ->where('user_type','=',"1")
        ->with(['businessOwnerType' => function ($q){
            $q->where('status', '!=', "2");
        }]);
        // $totalAr = MainUsers::select(
        //                     array('*', DB::raw('(SELECT count(*) FROM properties WHERE properties.agent_id = users.id AND status!=2) as count_properties'))
        //                 )
        //                 ->where('status','!=',2)
        //                 ->where('user_type','=',config('constants.USER_TYPE_AGENT'))
        //                 ->with(['properties' => function ($q){
        //                     $q->where('status', '!=', 2);
        //                 }]);

        if($agent_type){
            $agent_type_id = config('constants.businessOnwerS_TYPE.' . $agent_type . '.value');
            $totalAr = $totalAr->where('agent_type','=', $agent_type_id);
        }

        if($searchValue!= ""){
            $totalAr = $totalAr->where(function ($query) use($searchValue){
                return $query->where('full_name', 'LIKE', '%'.urlencode($searchValue).'%')
                            ->orWhere('email', 'LIKE', '%'.urlencode($searchValue).'%')
                            ->orWhere(DB::raw("CONCAT(`country_code`, ' ', `mobile_number`)"), 'LIKE','%'.urlencode($searchValue).'%')
                            ->orWhere('created_at', 'LIKE', '%'.urlencode($searchValue).'%');
                            // ->orWhere('count_properties', 'LIKE', '%'.urlencode($searchValue).'%');
            });
        }

        $setting = Setting::first();

        $totalRecords = $totalAr->get()->count();

        $totalAr = $totalAr->orderBy($sort, $sortBy)
            ->skip($start)
            ->take($rowperpage)
            ->get();
        
        $data_arr = [];
        foreach ($totalAr as $key => $data) {
            $full_name = isset($data->full_name) ? $data->full_name : '';
            $profile_photo = (isset($data->profile_image) && $data->profile_image != '') ? asset('uploads/general_users/'.$data->profile_image) : '';
            $email = isset($data->email) ? $data->email : '';
            $country_code = isset($data->country_code) ? $data->country_code : '';
            $mobile_number = isset($data->mobile_number) ? $data->mobile_number : '';
            $phone = urldecode($country_code) . ' ' . urldecode($mobile_number);

            if ($data->status == 1) {
                $status = '<i class="fa fa-check text-success inline"><spna class="hide">active</span></i>';
            } else {
                $status = '<i class="fa fa-times text-danger inline"><span class="hide">deactive</span></i>';
            }

            $show = route('businessOwner.show', ['id' => encrypt($data->id)]);
            $edit = route('businessOwner.edit', ['id' => encrypt($data->id)]);
            $delete = route('businessOwner.delete', ['id' => encrypt($data->id)]);

            $options = "";

            $options = '<a class="btn btn-sm show-eyes list box-shadow" href="' . $show . '" title="Show"> </a>';

            $options .= '<a class="btn btn-sm success paddingset" href="' . $edit . '" title="Edit"> <small><i class="material-icons">&#xe3c9;</i> </small></a> ';

            $options .= '<a class="btn paddingset delete-data" onclick="deleteData(this);" href="javascript:void(0)" data-href="'.$delete.'" title="Delete" data-name="'.urldecode($full_name).'"> <span class="fa fa-trash text-danger"></span> </a> ';

            // $aminity_image = $this->no_image;
            // if($data->image){
            //     $checkFile = $this->_image_uri . '/' . $data->image;
            //     $aminity_image = $checkFile;
            // }
            

            $data_arr[] = array(
                "checkbox" => '<label class="ui-check m-a-0"> <input type="checkbox" name="ids[]" value="' . $data->id . '" class="has-value" data-id="' . $data->id . '"><i class="dark-white"></i> <input class="form-control row_no has-value" name="row_ids[]" type="hidden" value="' . $data->id . '"> </label>',
                "full_name" => urldecode($full_name),
                "profile_photo" => ($profile_photo != '') ? '<img src="'.urldecode($profile_photo).'" style="height: 50px; width:50px;" data-pagespeed-url-hash="2317714144" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">' : '',
                "email" => urldecode($email),
                "mobile_number" => $phone,
                "join_date" => Carbon::parse($data->created_at)->format(env('DATE_FORMAT','Y-m-d') . ' h:i A'),
                "status" => $status,
                "options" => $options,
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecords,
            "aaData" => $data_arr
        );
        echo json_encode($response);
    }

    public function updateAll(Request $request)
    {
        if ($request->ids != "") {
            if ($request->action == "activate") {          
                $active  = MainUsers::wherein('id', $request->ids);
                $active->update(['status' => 1]);
            } elseif ($request->action == "block") {
                MainUsers::wherein('id', $request->ids)
                    ->update(['status' => 0]);
            } elseif ($request->action == "delete") {
                $users = MainUsers::wherein('id', $request->ids);
                foreach($users as $user){
                    if ($user->profile_image != "") {
                        File::delete($this->getUploadPath() . $user->profile_image);
                    }
                }

                MainUsers::wherein('id', $request->ids)
                    ->update(['status' => 2,'profile_image' => null]);
            }
        }else{
            return redirect()->route('businessOwners')->with('errorMessage',__('backend.select_row'));
        }
        return redirect()->route('businessOwners')->with('doneMessage', __('backend.saveDone'));
    }
}
