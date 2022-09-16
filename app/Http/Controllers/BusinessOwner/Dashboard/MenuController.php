<?php

namespace App\Http\Controllers\BusinessOwner\Dashboard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Items;
use App\Models\Modifiers;


class MenuController extends Controller
{
    private $uploadPath = "/uploads/menu/";
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
        return view("businessOwner.dashboard.menu.list");
    }

    /**
      * Display the specified resource.
      *
      * @param  \App\Models\MainUsers  $user
      * @return \Illuminate\Http\Response
      */
 
      public function create()
      {
            $category = Category::orderby('id','desc')->where('status',1)->get();
            $subCategory = SubCategory::orderby('id','desc')->where('status',1)->get();
            $items =  Items::orderby('id','desc')->where('status',0)->get();
            return view("businessOwner.dashboard.menu.add",compact('category','subCategory', 'items'));
      }


     public function store(Request $request)
     {
        dd($request);
        // echo "<pre>";print_r($request);exit;
        // $this->validateRequest();
         $menu = new items;
         $formFileName = "image";
            $fileFinalName_ar = ""; 

            if (request()->has('image')) 
            {

                $avatarName = time().'.'.request()->image->getClientOriginalExtension();
                $file = request()->file('image');
                $name=$avatarName;
                    $destinationPath = public_path('uploads/category');
                    // echo "<pre>";print_r($destinationPath);exit();
                    $imagePath = $destinationPath. "/".  $name;
                    $file->move($destinationPath, $name);

                
            }
         $menu->category_id = $request->category_id;
         $menu->sub_category_id = $request->sub_category_id;
         $menu->image = $avatarName;
        //  $menu->item_id = $request->item_id;
         $menu->name = $request->name;
         $menu->price = $request->price;
        //  $menu->item_preparing_time = $request->item_preparing_time;
        //  $menu->tax_name = $request->tax_name;
        //  $menu->tax = $request->tax;
         $menu->description = $request->description;
        //  $menu->addons_category = $request->addons_category;
         $menu->status = 1;
         // dd($menu);
         $menu->save(); 

         $modifiers = new Modifiers;
        
         $modifiers->name = $request->item_name; 
         $modifiers->price = $request->item_price;
        //  dd($modifiers);
         $modifiers->save();
        //  dd($menu);
         return $menu;
 
         return redirect()->route('menu')->with('success', __('backend.saveDone'));
     }

     public function validateRequest($id="")
     {
 
         if($id !="")
         {
             $validateData =request()->validate([
                 'category_id' =>'required',
                 'sub_category_id' => 'required',
                 'category_id' => 'required',
                 'image' => 'mimes:png,jpeg,jpg,gif,svg',
                //  'item_id' => 'required',
                //  'item_preparing_time' => 'required',
                //  'tax_name' => 'required',
                //  'tax' => 'required|numeric',
                 'description' => 'required',
                 'name' => 'required',
                 'price' => 'required|numeric',
                 'item_name' => 'required',
                 'item_price' => 'required|numeric'
             ]);
 
         }
         else{
 
             $validateData =request()->validate([
                 'category_id' => 'required',
                 'sub_category_id' => 'required',
                //  'item_id' => 'required',
                //  'item_preparing_time' => 'required',
                //  'tax_name' => 'required',
                //  'tax' => 'required|numeric',
                 'description' => 'required',
                 'name' => 'required',
                 'price' => 'required|numeric',
                 'image' => 'required|mimes:png,jpeg,jpg,gif,svg',
                 'item_name' => 'required',
                 'item_price' => 'required|numeric'
             ]);
             
         }
 
         return $validateData;
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