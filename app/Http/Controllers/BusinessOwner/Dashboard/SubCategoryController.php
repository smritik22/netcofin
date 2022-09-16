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
use Yajra\Datatables\Datatables;
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
        $subcategory = [];
        $subcategory['subcategory_list'] = SubCategory::with(['Category'])->where('status','!=',"2")->orderBy('id', 'desc')->get();
        $subcategory['category_name'] = Category::orderby('id','desc')->where('status','=',1)->get();
        // $category_name = Category::orderby('id','desc')->where('status','=',1)->get();
        return view("businessOwner.dashboard.subCategory.list", $subcategory);
        
        // //  $categories = Category::where('status','=',"1")->get();
        // //  $subCategory = SubCategory::orderby('id','desc')->where('status',1)->get();
        // //  echo "string";exit;
        //  return view("businessOwner.dashboard.subCategory.list", compact('category_name'));
     }

     public function filter(Request $request)
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
        $category = Category::orderby('id','desc')->where('status',1)->get();
         return view("businessOwner.dashboard.subCategory.add", compact('category'));
     }
 
     public function store(Request $request)
     {
         $subCategory = new SubCategory();
         $this->validateRequest();
        $subCategory->category_id = $request->category_id;
         $subCategory->name = $request->name;
         $subCategory->tax = $request->tax;
         $subCategory->status = 1;
         // dd($subCategory);
         $subCategory->save(); 
 
         return redirect()->route('sub-categories')->with('success', __('backend.saveDone'));
     }
 
     public function show($id)
     {
         $id = base64_decode($id);
         $subCategory = subCategory::find($id);
         $image_url = $this->image_uri;
         return view('businessOwner.dashboard.subCategory.show', compact('subCategory','image_url'));
     }
 
 
     /**
      * Show the form for editing the specified resource.
      *
      * @param  \App\Models\Product  $product
      * @return \Illuminate\Http\Response
      */
     public function edit(Request $request,$id)
     {
         $id = base64_decode($id);  
        // echo "tes:<pre>";
        // print_r($id);
        // exit;
        //  dd($id);
            $subcategory = SubCategory::with('Category')->find($id);
        
            $categories =  Category::where('status',"1")->get();
            if($subcategory){
                
                return view('businessOwner.dashboard.subCategory.edit', compact('subcategory', 'categories'));
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
        // dd($id);
         $this->validateRequest($id);
         $subCategory = SubCategory::find($id);
        //  dd($subCategory);
         $subCategory->category_id = $request->category_id;
         $subCategory->name = $request->name;
         $subCategory->tax = $request->tax;
         $subCategory->status = 1;
         $subCategory->save(); 
 
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
        //  dd($id);
         $id = base64_decode($id);
        $category = SubCategory::find($id);
         $category->status = 2;

         $category->save();
         
         return redirect()->route('sub-categories')
             ->with('success', __('backend.deleteDone'));
     }
 
     public function validateRequest($id="")
     {
 
         if($id !="")
         {
             $validateData =request()->validate([
                 'name' => 'required',
                 'tax'  => 'required|numeric',
                 'category_id' => 'required',
                //  'image' => 'mimes:png,jpeg,jpg,gif,svg',
             ]);
 
         }
         else{
 
             $validateData =request()->validate([
                 'name' => 'required',
                 'tax'  => 'required|numeric',
                 'category_id' => 'required',
                //  'image' => 'required|mimes:png,jpeg,jpg,gif,svg',
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
        $category_id = $request->get('category_name');
        $columnSortOrder = '';
        if (isset($order_arr[0]['dir']) && $order_arr[0]['dir'] != "") {
            $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        }
        
        $searchValue = $search_arr['value']; // Search value

        if ($columnIndex == 1) {
            $sort = 'category_id';
        }
        elseif ($columnIndex == 2) {
           $sort = 'name';
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

        $totalAr = SubCategory::where('status','!=',3);

        if($searchValue!= ""){
            $totalAr = $totalAr->where(function ($query) use($searchValue){
                 $query->where('name', 'LIKE', '%'.$searchValue.'%');
                            // ->orWhere('categories.name', 'LIKE', '%'.urlencode($searchValue).'%');
            });
        }
        if ($category_id) {
            // dd($category_name);
            $totalAr->where('sub_categories.category_id','=',$category_id);
         }
 
        $totalRecords = $totalAr->get()->count();

        $totalAr = $totalAr->orderBy($sort, $sortBy)
            ->skip($start)
            ->take($rowperpage)
            ->get();
        
        $data_arr = [];
        foreach ($totalAr as $key => $data) {
           
            $category_id = isset($data->category_id) ? $data->category_id : '';
            $name = isset($data->name) ? $data->name : '';
            $tax = isset($data->tax) ? $data->tax : '';
            $category_name = isset($data->category_name) ? $data->category_name : '';
            $tax1 = '<div class="text_list"><p class="text_item">' . $tax . '</p></div>';
            $status ='<div class="customer-toggle"><div class="header-toggle"><input data-id="' . $data->id . '" class="toggle" id="toggle'.$data->id.'" onchange="changeStatus('.$data->id.','.$data->status.')"  type="checkbox"  '.(($data->status == 1) ? 'checked=""' : "" ).' ><label for="toggle'.$data->id.'"></label></div></div>';
            $category = Category::where('id',$data->category_id)->first();
                    
           
            $show = route('sub-category.show', ['id' => base64_encode($data->id)]);
            $edit = route('sub-category.edit', ['id' => base64_encode($data->id)]);
            $delete = route('sub-category.delete', ['id' => base64_encode($data->id)]);

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

            $data_arr[] = array(
                "checkbox" => '<label class="ui-check m-a-0"> <input type="checkbox" onclick="checkChange();" name="ids[]" value="' . $data->id . '" class="has-value" data-id="' . $data->id . '"><i class="dark-white"></i> <input class="form-control row_no has-value"  name="row_ids[]" type="hidden" value="' . $data->id . '"> </label>',
                "category_id" => $category->name,
                "name" => urldecode($name),
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
    
    
    // public function updateAll(Request $request)
    //  {
    //      if($request->ajax())
    //      {
    //          // echo "<pre>";print_r($request->toArray());exit();
    //          if ($request->ids != "") {
    //              $ids= explode(",", $request->ids);
    //                 //  Category::whereIn('id',$ids)->update(['status' => $status]);
 
    //              return response()->json(['success' => true,'msg'=>$message]);
    //          }
    //          return response()->json(['success' => false,'msg'=>'Something went wrong!!']);
    //      }
    //  }

    public function statusUpdate(Request $request)
    { 
        // echo "<pre>";print_r($request->status);exit();
        // if($request->ajax())
        // {
            if ($request->id != "") {
                // $ids= explode(",", $request->id);
                // $status = $request->status;
                    if($request->status==2){
                    SubCategory::where('id',$request->id)->update(['status' => 2]);

                    }else{
                        SubCategory::where('id',$request->id)->update(['status' => 1]);
    
                        }
                }
               
            // echo "<pre>";print_r($request->toArray());exit();
        // }
        // echo "<pre>";print_r($request->status);exit();
    }
}