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
use Redirect;
use Helper;
use Hash;
use Image;
use Illuminate\Validation\Rule; 
use Illuminate\Support\Carbon;
use App\Models\Setting;
use App\Models\Category;
use App\Models\MainUsers;
use App\Models\Language;

class CategoryController extends Controller
{
    // Define Default Variables
    private $uploadPath = "/uploads/category/";
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
    public function index(Request $request)
    {
        $category = [];
        $category['category_list'] = Category::where('status','!=',"2")->orderBy('id', 'desc')->get();
        // echo '<pre>'; print_r($category['category_list']); exit;
        return view("dashboard.category.list", $category);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MainUsers  $user
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $businessOwner_list['businessOwners'] =  MainUsers::where('status',"1")->where('user_type','1')->get();
        return view("dashboard.category.create",$businessOwner_list);
    }

    public function store(Request $request)
    {
        $validations = $this->validateRequest($request);
        if ($validations->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validations)
                        ->withInput();
        }
       
        $formFileName = "image";
        $fileFinalName_ar = "";

        $category = Category::where('name',$request->name)->where('business_owner_id',$request->business_owner_id)->get()->toArray();
       
        if(!empty($category)){
            return redirect()->route('category.create')->with('errorMessage', __('backend.alreadyExists'));
        }
        if ($request->image != "") {
            $newname = $_FILES[$formFileName]['name'];
            $ext = pathinfo($newname, PATHINFO_EXTENSION);
            $insertimage = 'category-'.time().'.'.$ext; 
            $tmpfile = $_FILES[$formFileName]['tmp_name'];
            $upload_dir =  public_path()."/" . $this->getUploadPath();

            if (!file_exists($upload_dir)) {
              \File::makeDirectory($upload_dir, 0777, true);
            }
            move_uploaded_file($tmpfile, $upload_dir.$insertimage);
            $source_imagebanner = $upload_dir.$insertimage;
            $file_namebanner= "categories-".time().'-'.str_pad(rand(0,1000), 4, '0', STR_PAD_LEFT).".".$ext;
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
        $data = [];
        $data['name'] = $request->name;
        $data['business_owner_id'] = $request->businessowner;
        $data['image'] = $fileFinalName_ar;
        $data['price'] = $request->price;
        $data['discount'] = $request->discount;
        Category::create($data);

        return redirect()->route('categories')->with('success', __('backend.addDone'));
    }

    public function show($id)
    {
        $id = decrypt($id);
        // $user = Category::with(['MainUsers'])->find($id);
        $category = Category::find($id);
        $business_owner = MainUsers::where('id',$category->business_owner_id)->pluck('full_name');
        $image_url = $this->image_uri;
        return view('dashboard.category.show', compact('category','image_url','business_owner'));
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
        $category = Category::find($id);
        $image_url = $this->image_uri;
        $businessOwners =  MainUsers::where('status',"1")->get();
        if($category){
            return view('dashboard.category.edit', compact('category', 'image_url','businessOwners'));
        }else{
            return redirect()->route('categories')->with('errorMessage', __('backend.noDataFound'));
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
        $validations = $this->validateRequest($request,$id);
        if ($validations->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validations)
                        ->withInput();
        }

        $category = Category::find($id);

        

        if ($request->photo_delete == 1) {
            if ($category->image != "") {
                File::delete($this->getUploadPath() . $category->image);
            }

            $category->image = "";
        }

        $formFileName = "image";
        $fileFinalName_ar = $category->image;
        
        if ($request->image != "") {
                    
            $newname = $_FILES[$formFileName]['name'];
            $ext = pathinfo($newname, PATHINFO_EXTENSION);
            $insertimage = 'category-'.time().'.'.$ext; 
            $tmpfile = $_FILES[$formFileName]['tmp_name'];
            $upload_dir =  public_path(). $this->getUploadPath();
           
            if (!file_exists($upload_dir)) {
              \File::makeDirectory($upload_dir, 0777, true);
            }
            move_uploaded_file($tmpfile, $upload_dir.$insertimage);
            $file_namebanner= "categories-".time().'-'.str_pad(rand(0,1000), 4, '0', STR_PAD_LEFT).".".$ext;
            $image_destinationbanner = $upload_dir.$file_namebanner;
            $source_imagebanner = $upload_dir.$insertimage;
            Helper::correctImageOrientation($source_imagebanner);
            $compress_images = Helper::compressImage($source_imagebanner, $image_destinationbanner);
            Helper::correctImageOrientation($image_destinationbanner);
           
           
            unlink($source_imagebanner);
            $fileFinalName_ar=$file_namebanner;
           
            if (!file_exists($upload_dir)) {
              \File::makeDirectory($upload_dir, 0775, true);
            }
        }
        
        if ($fileFinalName_ar != "") {
            // Delete a User file
            if ($category->image != "") {
                File::delete($this->getUploadPath() . $category->image);
            }

            $category->image = $fileFinalName_ar;
        }
 
        $category->name = urlencode($request->name);
        $category->business_owner_id = urlencode($request->businessowner);
        $category->image = $fileFinalName_ar;
        $category->price = $request->price;
        $category->discount = $request->discount;
        $category->save(); 

        return redirect()->route('categories')->with('success', __('backend.saveDone'));
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


    public function updateAll(Request $request)
    {
        if ($request->ids != "") {
            if ($request->action == "activate") {          
                $active  = Category::wherein('id', $request->ids);
                $active->update(['status' => 1]);
            } elseif ($request->action == "block") {
                Category::wherein('id', $request->ids)
                    ->update(['status' => 0]);
            } elseif ($request->action == "delete") {
                $categories = Category::wherein('id', $request->ids);
                foreach($categories as $user){
                    if ($user->image != "") {
                        File::delete($this->getUploadPath() . $user->image);
                    }
                }

                Category::wherein('id', $request->ids)
                    ->update(['status' => 2,'image' => null]);
            }
        }else{
            return redirect()->route('categories')->with('errorMessage',__('backend.select_row'));
        }
        return redirect()->route('categories')->with('doneMessage', __('backend.saveDone'));
    }

    public function validateRequest($request,$id="",$lang_id = "",$childId="")
    {
        $validation_messages = [
            'name.required' => 'Title is required.',
            'name.string' => 'Only string allowed',
            'name.max' => 'Max length exceeded',
            'businessowner.required' => 'Please select Business owener.',
        ];

        if( $id !="" )
        {
            $validator = Validator::make($request->all(), [
                'name' => [
                                    'required',
                                    'string',
                                    'max:50',
                                    'alpha',
                                ],
                'businessowner' => [
                            'required',
                        ],
                
            ],
            $validation_messages
        );

        }else{
            $validator = Validator::make($request->all(), [
                'name' => [
                    'required',
                    'string',
                    'max:30',
                    'regex:/^[a-zA-Z]+$/u',
                ],
                'businessowner' => [
                    'required',
                ],
            ],
            $validation_messages
        );
        }

        return $validator;
    }
}
