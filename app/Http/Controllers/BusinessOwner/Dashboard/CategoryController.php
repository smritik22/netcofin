<?php

namespace App\Http\Controllers\BusinessOwner\Dashboard;

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
     
        $category = Category::where('status','!=',"2")->orderBy('id', 'desc')->get();
        return view("businessOwner.dashboard.Category.list", compact('category'));
    }

    public function filter()
    {
        
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MainUsers  $user
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view("businessOwner.dashboard.Category.add");
    }

    public function store(Request $request)
    {
        
        $category = new Category();
        $this->validateRequest();
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

        $category->name = $request->name;
        $category->tax = $request->tax;
        $category->status = 1;
        $category->image = $avatarName;
        // dd($category);
        $category->save(); 

        return redirect()->route('categories')->with('success', __('backend.saveDone'));
    }

    public function show($id)
    {
        $id = base64_decode($id);
        $category = Category::find($id);
        $image_url = $this->image_uri;
        return view('businessOwner.dashboard.Category.show', compact('category','image_url'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = base64_decode($id);
    //    dd($id);
        $category = Category::find($id);
        $image_url = $this->image_uri;
        if($category){
            return view('businessOwner.dashboard.Category..edit', compact('category', 'image_url'));
        }else{
            return redirect()->route('categories')->with('errorMessage', __('backend.noDataFound'));
        }
    }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\product  $product
    //  * @return \Illuminate\Http\Response
    //  */
    public function update(Request $request,$id)
    {
        $this->validateRequest($id);
        $category = Category::find($id);
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

             $category->update([                 
                'image' => $avatarName,
            ]);
        }
 
        $category->name = $request->name;
        $category->tax = $request->tax;
        $category->status = 1;
        $category->save(); 

        return redirect()->route('categories')->with('success', __('backend.saveDone'));
    }



    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Models\Product  $product
    //  * @return \Illuminate\Http\Response
    //  */
    public function destroy($id)
    {
        $id = base64_decode($id);
        $category = Category::find($id);
        $category->status = 2;
        $category->save();
        
        return redirect()->route('categories')
            ->with('success', __('backend.deleteDone'));
    }


   

    public function validateRequest($id="")
    {

        if($id !="")
        {
            $validateData =request()->validate([
                'name' => 'required',
                'tax'  => 'required|numeric',
                'image' => 'mimes:png,jpeg,jpg,gif,svg',
            ]);

        }
        else{

            $validateData =request()->validate([
                'name' => 'required',
                'tax'  => 'required|numeric',
                'image' => 'required|mimes:png,jpeg,jpg,gif,svg',
            ]);
            
        }

        return $validateData;
    }

    public function anyData(Request $request)
     {
        //  echo '<pre>'; print_r($request->all());
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
        if (isset($order_arr[0]['dir']) && $order_arr[0]['dir'] != "") {
            $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        }
        
        $searchValue = $search_arr['value']; // Search value

        if ($columnIndex == 1) {
            $sort = 'name';
        }
        elseif ($columnIndex == 2) {
           $sort = 'image';
        } 
        elseif ($columnIndex == 3) {
           $sort = 'tax';
        } 
        elseif ($columnIndex==4) {
           $sort = 'status';
        }  
        else {
            $sort = 'id';
        }

        $sortBy = 'DESC';
        if ($columnSortOrder != "") {
            $sortBy = $columnSortOrder;
        }

        $totalAr = Category::where('status','!=',3);

        // if($searchValue!= ""){
        //     $totalAr = $totalAr->where(function ($query) use($searchValue){
        //          $query->where('name', 'LIKE', '%'.$searchValue.'%');
        //                     // ->orWhere('categories.name', 'LIKE', '%'.urlencode($searchValue).'%');
        //     });
        // }
        // print ("245 : " . __LINE__ . "<br>"); exit ;
        // dd($totalAr->toSql());
        // $setting = Setting::first();
        // dd($category_id);
        // if ($category_id) {
        //     // dd($category_name);
        //     $totalAr->where('sub_categories.category_id','=',$category_id);
        //  }
 
        $totalRecords = $totalAr->get()->count();

        $totalAr = $totalAr->orderBy($sort, $sortBy)
            ->skip($start)
            ->take($rowperpage)
            ->get();
        
        $data_arr = [];
        foreach ($totalAr as $key => $data) {
            $name = isset($data->name) ? $data->name : '';
            $image = isset($data->image) ? $data->image : '';
            $tax = isset($data->tax) ? $data->tax : '';
             $image = $this->no_image;
            if($data->image){
                $checkFile = $this->image_uri . '/' . $data->image;
                $image = $checkFile;
            }
            $tax1 = '<div class="text_list"><p class="text_item">' . $tax . '</p></div>';
            $image_show = '<div class="category-img"><a href="' . $image . '" alt="' . $image . '" target="_blank" style="cursor: pointer;"><img src="' . $image . '" alt="' . $image . '" width="80" height="40"></a></div>';
           
            // if ($data->status == 1) {
            //     $status ='<div class="customer-toggle"><div class="header-toggle"><input data-id="' . $data->id . '" class="toggle" id="toggle1"  type="checkbox"  " ' . $data->status . '" checked="" ><label for="toggle1"></label></div></div>';
            // } else {
            //     $status ='<div class="customer-toggle"><div class="header-toggle"><input data-id="' . $data->id . '" class="toggle" id="toggle1"  type="checkbox"  " ' . $data->status . '"  ><label for="toggle1"></label></div></div>';
            // }
            $status ='<div class="customer-toggle"><div class="header-toggle"><input data-id="' . $data->id . '" class="toggle" id="toggle'.$data->id.'" onchange="changeStatus('.$data->id.','.$data->status.')"  type="checkbox"  '.(($data->status == 1) ? 'checked=""' : "" ).' ><label for="toggle'.$data->id.'"></label></div></div>';
            
            $show = route('category.show', ['id' => base64_encode($data->id)]);
            $edit = route('category.edit', ['id' => base64_encode($data->id)]);
            $delete = route('category.delete', ['id' => base64_encode($data->id)]);

            $image = asset('assets/frontend/images/icon_edit.svg');
            $image1 = asset('assets/frontend/images/icon_delete.svg');

            $options = "";

            // $options = '<a class="btn btn-sm show-eyes list box-shadow" href="' . $show . '" title="Show"> </a>';

            $options = '<a href="' . $edit . '" class="table-icon action_edit">
                        <span class="table-edit-icon"><img src="' . $image . '" alt="icon-edit.svg"></span>
                    </a>';
                $options.= '<a href="' . $delete . '" class="table-icon action_delete">
                <span class="table-edit-icon"><img src="' . $image1 . '" alt="icon-delete.svg"></span>
            </a>';
            // $options .= '<a class="btn btn-sm success paddingset" href="' . $edit . '" title="Edit"> <small><i class="material-icons">&#xe3c9;</i> </small></a> ';

            // $options .= '<a class="btn paddingset delete-data" onclick="deleteData(this);" href="javascript:void(0)" data-href="'.$delete.'" title="Delete" data-name="'.urldecode($name).'"> <span class="fa fa-trash text-danger"></span> </a> ';


            // $aminity_image = $this->no_image;
            // if($data->image){
            //     $checkFile = $this->_image_uri . '/' . $data->image;
            //     $aminity_image = $checkFile;
            // }

            $data_arr[] = array(
                "checkbox" => '<label class="ui-check m-a-0"> <input type="checkbox" onclick="checkChange();" name="ids[]" value="' . $data->id . '" class="has-value" data-id="' . $data->id . '"><i class="dark-white"></i> <input class="form-control row_no has-value"  name="row_ids[]" type="hidden" value="' . $data->id . '"> </label>',
                "name" => urldecode($name),
                "image" => $image_show,
                "tax" => $tax1,
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
    
    public function statusUpdate(Request $request)
    { 
        // if($request->ajax())
        // {
            if ($request->id != "") {
                // $ids= explode(",", $request->id);
                // $status = $request->status;
                if($request->status==2){
                    Category::where('id',$request->id)->update(['status' => 2]);
                    // echo "<pre>";print_r($request->status);exit();

                    }else{
                        // echo "<pre>";print_r($request->status);exit();
                        Category::where('id',$request->id)->update(['status' => 1]);
                        // echo "test","<pre>";print_r($request->status);exit();
    
                        }
                }
               
            // echo "<pre>";print_r($request->toArray());exit();
        // }
        // echo "<pre>";print_r($request->status);exit();
    } 
 
}
