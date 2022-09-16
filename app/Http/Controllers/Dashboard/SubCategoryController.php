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
use App\Models\SubCategory;
use App\Models\MainUsers;
use App\Models\Language;

class SubCategoryController extends Controller
{
    // Define Default Variables
    private $uploadPath = "/uploads/sub-category/";
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
        $subcategory = [];
        $subcategory['subcategory_list'] = SubCategory::with(['Category'])->where('status','!=',"2")->orderBy('id', 'desc')->get();
        return view("dashboard.sub-category.list", $subcategory);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MainUsers  $user
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $category_list['categories'] =  Category::where('status',"1")->get();
        return view("dashboard.sub-category.create",$category_list);
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

        $subcategory = SubCategory::where('name',$request->name)->where('category_id',$request->category_id)->get()->toArray();
       
        if(!empty($subcategory)){
            return redirect()->route('sub-category.create')->with('errorMessage', __('backend.alreadyExists'));
        }
        if ($request->image != "") {
            $newname = $_FILES[$formFileName]['name'];
            $ext = pathinfo($newname, PATHINFO_EXTENSION);
            $insertimage = 'sub-category-'.time().'.'.$ext; 
            $tmpfile = $_FILES[$formFileName]['tmp_name'];
            $upload_dir =  public_path()."/" . $this->getUploadPath();

            if (!file_exists($upload_dir)) {
              \File::makeDirectory($upload_dir, 0777, true);
            }
            move_uploaded_file($tmpfile, $upload_dir.$insertimage);
            $source_imagebanner = $upload_dir.$insertimage;
            $file_namebanner= "sub-categories-".time().'-'.str_pad(rand(0,1000), 4, '0', STR_PAD_LEFT).".".$ext;
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
        $data['category_id'] = $request->category_id;
        $data['image'] = $fileFinalName_ar;
        SubCategory::create($data);

        return redirect()->route('sub-categories')->with('success', __('backend.addDone'));
    }

    public function show($id)
    {
        $id = decrypt($id);
        $subcategory = SubCategory::with(['Category'])->find($id);
        $image_url = $this->image_uri;
        return view('dashboard.sub-category.show', compact('subcategory','image_url'));
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
        $subcategory = SubCategory::with(['Category'])->find($id);
        $image_url = $this->image_uri;
        $categories =  Category::where('status',"1")->get();
        if($subcategory){
            return view('dashboard.sub-category.edit', compact('subcategory', 'image_url','categories'));
        }else{
            return redirect()->route('sub-categories')->with('errorMessage', __('backend.noDataFound'));
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
        
        $subcategory = SubCategory::find($id);

        

        if ($request->photo_delete == 1) {
            if ($subcategory->image != "") {
                File::delete($this->getUploadPath() . $subcategory->image);
            }

            $subcategory->image = "";
        }

        $formFileName = "image";
        $fileFinalName_ar = $subcategory->image;
        
        if ($request->image != "") {
                    
            $newname = $_FILES[$formFileName]['name'];
            $ext = pathinfo($newname, PATHINFO_EXTENSION);
            $insertimage = 'sub-category-'.time().'.'.$ext; 
            $tmpfile = $_FILES[$formFileName]['tmp_name'];
            $upload_dir =  public_path(). $this->getUploadPath();
           
            if (!file_exists($upload_dir)) {
              \File::makeDirectory($upload_dir, 0777, true);
            }
            move_uploaded_file($tmpfile, $upload_dir.$insertimage);
            $file_namebanner= "sub-categories-".time().'-'.str_pad(rand(0,1000), 4, '0', STR_PAD_LEFT).".".$ext;
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
            if ($subcategory->image != "") {
                File::delete($this->getUploadPath() . $subcategory->image);
            }

            $subcategory->image = $fileFinalName_ar;
        }
 
        $subcategory->name = urlencode($request->name);
        $subcategory->category_id = $request->category_id;
        $subcategory->image = $fileFinalName_ar;
        $subcategory->save(); 

        return redirect()->route('sub-categories')->with('success', __('backend.saveDone'));
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
                $active  = SubCategory::wherein('id', $request->ids);
                $active->update(['status' => 1]);
            } elseif ($request->action == "block") {
                SubCategory::wherein('id', $request->ids)
                    ->update(['status' => 0]);
            } elseif ($request->action == "delete") {
                $categories = SubCategory::wherein('id', $request->ids);
                foreach($categories as $user){
                    if ($user->image != "") {
                        File::delete($this->getUploadPath() . $user->image);
                    }
                }

                SubCategory::wherein('id', $request->ids)
                    ->update(['status' => 2,'image' => null]);
            }
        }else{
            return redirect()->route('sub-categories')->with('errorMessage',__('backend.select_row'));
        }
        return redirect()->route('sub-categories')->with('doneMessage', __('backend.saveDone'));
    }

    public function validateRequest($request,$id="",$lang_id = "",$childId="")
    {
        $validation_messages = [
            'name.required' => 'Title is required.',
            'name.string' => 'Only string allowed',
            'name.max' => 'Max length exceeded',
            'category_id.required' => 'Please select category.',
        ];

        if( $id !="" )
        {
            $validator = Validator::make($request->all(), [
                'name' => [
                                    'required',
                                    'string',
                                    'max:30',
                                    'alpha',
                                ],
                'category_id' => [
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
                'category_id' => [
                    'required',
                ],
            ],
            $validation_messages
        );
        }

        return $validator;
    }
}
