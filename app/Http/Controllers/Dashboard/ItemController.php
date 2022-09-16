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
use App\Models\Items;
use App\Models\MainUsers;
use App\Models\Language;

class ItemController extends Controller
{
    // Define Default Variables
    private $uploadPath = "/uploads/items/";
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
        $items = [];
        $items['items_list'] = Items::with(['Category'])->where('status','!=',"2")->orderBy('id', 'desc')->get();
        return view("dashboard.items.list", $items);
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
        $category_list['business_owners'] = MainUsers::where('status',"1")->where('user_type','1')->get();
        return view("dashboard.items.create",$category_list);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required', 
            'category' => 'required',  
            'business_owner' => 'required',  
            'subcategory' => 'required',  
        ]);
       
        
        $formFileName = "image";
        $fileFinalName_ar = "";

        $item = Items::where('name',$request->name)->where('category_id',$request->category)->where('sub_category_id',$request->subcategory)->where('business_owner_id',$request->business_owner)->get()->toArray();
       
        if(!empty($item)){
            return redirect()->route('items.create')->with('errorMessage', __('backend.alreadyExists'));
        }
        if ($request->image != "") {
            $newname = $_FILES[$formFileName]['name'];
            $ext = pathinfo($newname, PATHINFO_EXTENSION);
            $insertimage = 'items-'.time().'.'.$ext; 
            $tmpfile = $_FILES[$formFileName]['tmp_name'];
            $upload_dir =  public_path()."/" . $this->getUploadPath();

            if (!file_exists($upload_dir)) {
              \File::makeDirectory($upload_dir, 0777, true);
            }
            move_uploaded_file($tmpfile, $upload_dir.$insertimage);
            $source_imagebanner = $upload_dir.$insertimage;
            $file_namebanner= "items-".time().'-'.str_pad(rand(0,1000), 4, '0', STR_PAD_LEFT).".".$ext;
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
        $data['category_id'] = $request->category;
        $data['sub_category_id'] = $request->subcategory;
        $data['price'] = $request->price;
        $data['business_owner_id'] = $request->business_owner;
        $data['image'] = $fileFinalName_ar;
        $data['description'] = $request->description;
        $data['status'] = "1";
        Items::create($data);

        return redirect()->route('items')->with('success', __('backend.addDone'));
    }

    public function show($id)
    {
        $id = decrypt($id);
        $items =  DB::table('items as i')->join('categories as c',"c.id",'=','i.category_id')->join('sub_categories as sc',"sc.id",'=','i.sub_category_id')->join('users as u',"u.id",'=','i.business_owner_id')->select('i.*','c.name as category_name','sc.name as subcategory_name','u.full_name as business_owner_name')->where('i.id',$id)->where('i.status',"1")->get();
        $image_url = $this->image_uri;
        return view('dashboard.items.show', compact('items','image_url'));
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
        $items =  DB::table('items as i')->join('categories as c',"c.id",'=','i.category_id')->join('sub_categories as sc',"sc.id",'=','i.sub_category_id')->join('users as u',"u.id",'=','i.business_owner_id')->select('i.*','c.name as category_name','sc.name as subcategory_name','u.full_name as business_owner_name')->where('i.id',$id)->where('i.status',"1")->get();
        // $items =  DB::table('items as i')->select('i.*')->where('i.id',$id)->get()->toArray();
        $image_url = $this->image_uri;
        $business_owners =  MainUsers::where('status',"1")->where('user_type','1')->get();
        if($items){
            return view('dashboard.items.edit', compact('items', 'image_url','business_owners'));
        }else{
            return redirect()->route('items')->with('errorMessage', __('backend.noDataFound'));
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
            'name' => 'required', 
            'category' => 'required',  
            'business_owner' => 'required',  
            'subcategory' => 'required',  
        ]);

        $items = Items::find($id);

        

        if ($request->photo_delete == 1) {
            if ($items->image != "") {
                File::delete($this->getUploadPath() . $items->image);
            }

            $items->image = "";
        }

        $formFileName = "image";
        $fileFinalName_ar = $items->image;
        
        if ($request->image != "") {
                    
            $newname = $_FILES[$formFileName]['name'];
            $ext = pathinfo($newname, PATHINFO_EXTENSION);
            $insertimage = 'items-'.time().'.'.$ext; 
            $tmpfile = $_FILES[$formFileName]['tmp_name'];
            $upload_dir =  public_path(). $this->getUploadPath();
           
            if (!file_exists($upload_dir)) {
              \File::makeDirectory($upload_dir, 0777, true);
            }
            move_uploaded_file($tmpfile, $upload_dir.$insertimage);
            $file_namebanner= "items-".time().'-'.str_pad(rand(0,1000), 4, '0', STR_PAD_LEFT).".".$ext;
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
            if ($items->image != "") {
                File::delete($this->getUploadPath() . $items->image);
            }

            $items->image = $fileFinalName_ar;
        }
        
        $items->name = urlencode($request->name);
        $items->price = $request->price;
        $items->sub_category_id = $request->subcategory;
        $items->category_id = $request->category;
        $items->business_owner_id = $request->business_owner;
        $items->description = $request->description;
        $items->image = $fileFinalName_ar;
        $items->save(); 

        return redirect()->route('items')->with('success', __('backend.saveDone'));
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
                $active  = Items::wherein('id', $request->ids);
                $active->update(['status' => 1]);
            } elseif ($request->action == "block") {
                Items::wherein('id', $request->ids)
                    ->update(['status' => 0]);
            } elseif ($request->action == "delete") {
                $categories = Items::wherein('id', $request->ids);
                foreach($categories as $user){
                    if ($user->image != "") {
                        File::delete($this->getUploadPath() . $user->image);
                    }
                }

                Items::wherein('id', $request->ids)
                    ->update(['status' => 2,'image' => null]);
            }
        }else{
            return redirect()->route('items')->with('errorMessage',__('backend.select_row'));
        }
        return redirect()->route('items')->with('doneMessage', __('backend.saveDone'));
    }

    public function categories(Request $request)
    {
        $business_owner_id = $request->id;
        $categories = Category::where('status','!=',"2")->where('business_owner_id',$business_owner_id)->select('name','id')->get()->toArray();
        $data_arr = [];
        if(!empty($categories)){
            foreach ($categories as $key => $value) {
                $data_arr[] = "<option value='".$value['id']."'>".$value['name']."</option>";
            }
        }else{
            $data_arr[] = "<option>No data</option>";
        }
        echo json_encode($data_arr);
    }

    public function subcategories(Request $request)
    {
        $id = $request->id;
        $business_owner_id = $request->business_owner_id;
        SubCategory::with(['Category'])->where('status','!=',"2")->get();
        $sub_categories = SubCategory::with(['Category' => function($q) use ($business_owner_id){
            $q->where('business_owner_id',$business_owner_id);
        }])->select('id','name')->where('category_id',$id)->where('status','1')->get()->toArray();

        $data_arr = [];
        if(!empty($sub_categories)){
            foreach ($sub_categories as $key => $value) {
                $data_arr[] = "<option value='".$value['id']."'>".$value['name']."</option>";
            }
        }else{
            $data_arr[] = "<option>No data</option>";
        }
        echo json_encode($data_arr);
    }
}
