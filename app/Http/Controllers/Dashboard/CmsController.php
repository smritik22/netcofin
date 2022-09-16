<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\WebmasterSection;
use App\Models\Cms;
use App\Models\Language;
use Auth;
use File;
use Illuminate\Config;
use Helper;
use Illuminate\Http\Request;
use Redirect;
use DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToArray;
use Yajra\Datatables\Datatables;

class CmsController extends Controller
{

    // Define Default Variables

    private $uploadPath = "/uploads/cms/";
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
     * string $stat
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $cms = Cms::get();

        $cmsData = count($cms);

        return view("dashboard.cms.list",
            compact("cms","cmsData"));

    }

    public function create()
    {

        return view("dashboard.cms.create");
    }


    public function store(Request $request)
    {       

        $this->validateRequest();
        $cms = new Cms();

        $cms->page_name = $request->page_name;
        $cms->slugged_name = Str::slug($request->page_name,"-", \Helper::currentLanguage()->code);
        $cms->description = $request->page_content;
        $cms->status = 1;
        $cms->create_by = Auth::user()->id;
        $cms->update_by = Auth::user()->id;
        $cms->language_id = 1;
        $cms->parentid = 0;
        $cms->created_at = date('Y-m-d H:i:s');
        $cms->save(); 
        
        return redirect()->route('cms')->with('success', 'CMS updated successfully.');
    }

    public function storeLang(Request $request){
        $this->validateRequest();
        
        $parentData = Cms::find($request->cms_parent_id);
        $lang_id = $request->cms_language_id;
        $parent_id = $parentData->id;
        $cms_id = $request->cms_page_id;
        $page_name = $request->page_name;
        $content = $request->page_content;

        $side_image_name = "side_image";
        $video = "video";
        $profile_doc = "profile_doc";

        $side_image_final_name_ar = "";

        if ($request->$side_image_name != "") {
            $side_image_final_name_ar = 'about_us_' .time() . rand(1111,
                    9999) . '.' . $request->file($side_image_name)->getClientOriginalExtension();
            $uploadPath = public_path()."/uploads/settings/";
            //$path = $this->getUploadPath();
            $request->file($side_image_name)->move($uploadPath, $side_image_final_name_ar);
            
            $updateDoc2 = Cms::find($cms_id);
            $updateDoc2->document_two = $side_image_final_name_ar;
            $updateDoc2->save();
        }

        $video_name_ar = "";
        if ($request->$video != "") {
            $video_name_ar = 'about_us_Video_' .time() . rand(1111,
                    9999) . '.' . $request->file($video)->getClientOriginalExtension();
            $uploadPath = public_path()."/uploads/settings/";

            //$path = $this->getUploadPath();

            $request->file($video)->move($uploadPath, $video_name_ar);

            $updateURL = Cms::find($cms_id);
            $updateURL->url = $video_name_ar;
            $updateURL->save();
        }

        $profile_doc_name_ar = "";
        if ($request->$profile_doc != "") {
            $profile_doc_name_ar = 'profile_' .time() . rand(1111,
                    9999) . '.' . $request->file($profile_doc)->getClientOriginalExtension();
            $uploadPath = public_path()."/uploads/settings/";

            //$path = $this->getUploadPath();

            $request->file($profile_doc)->move($uploadPath, $profile_doc_name_ar);

            $updateDoc1 = Cms::find($cms_id);
            $updateDoc1->document_one = $profile_doc_name_ar;
            $updateDoc1->save();
        }

        $newUser = Cms::updateOrCreate([
            'language_id' => $lang_id,
            'parentid' => $parent_id,
        ],[
            'page_name' => $page_name,
            // 'slugged_name' => Str::slug($page_name,"-", $language->code),
            'description' => $content,
            'status' => 1,
            'create_by' => Auth::user()->id,
            'update_by' => Auth::user()->id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        // dd($newUser->toSql());
        return redirect()->route('cms')->with('success', 'Cms created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $cms = Cms::find($id);
        $image_url = isset($this->image_uri) ? $this->image_uri : '';
        return view('dashboard.cms.edit', compact('cms', 'image_url'));
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
        $this->validateRequest();

        $cms = Cms::find($id);

        $side_image_name = "side_image";
        $video = "video";
        $profile_doc = "profile_doc";

        $side_image_final_name_ar = "";
        if ($request->$side_image_name != "") {
            
            $side_image_final_name_ar = urlencode($cms->page_name) . '_' . time() . rand(1111, 9999) . '.' . $request->file($side_image_name)->getClientOriginalExtension();
            $uploadPath = public_path()."/uploads/settings/";
            $request->file($side_image_name)->move($uploadPath, $side_image_final_name_ar);

            $cms->document_two = $side_image_final_name_ar;
        }

        $video_name_ar = "";
        if ($request->$video != "") {
            $video_name_ar = 'about_us_Video_' .time() . rand(1111,9999) . '.' . $request->file($video)->getClientOriginalExtension();
            $uploadPath = public_path()."/uploads/settings/";
            //$path = $this->getUploadPath();
            $request->file($video)->move($uploadPath, $video_name_ar);

            $cms->url = $video_name_ar;
        }

        $profile_doc_name_ar = "";
        if ($request->$profile_doc != "") {
            $profile_doc_name_ar = 'profile_' .time() . rand(1111, 9999) . '.' . $request->file($profile_doc)->getClientOriginalExtension();
            $uploadPath = public_path()."/uploads/settings/";
            //$path = $this->getUploadPath();
            $request->file($profile_doc)->move($uploadPath, $profile_doc_name_ar);
            
            $cms->document_one = $profile_doc_name_ar;
        }


        if($cms->id == 6)
        {
            $formFileName = "image";
            $fileFinalName_ar = "";

            if (request()->has('image')) 
            {

                $avatarName = time(). rand(1111,
                9999) .'.' .request()->image->getClientOriginalExtension();
                $file = request()->file('image');
                $name=$avatarName;
                    $destinationPath = public_path('uploads/cms');
                    $imagePath = $destinationPath. "/".  $name;
                    $file->move($destinationPath, $name);

                    $cms->update([                 
                        'image' => $avatarName,
                    ]);
            }

            $formFileNameOther = "other_image";
            $fileFinalNameOther_ar = "";

            if (request()->has('other_image')) 
            {

                $avatarNameOther = time(). rand(1111,
                9999) .'.' .request()->other_image->getClientOriginalExtension();
                $fileOther = request()->file('other_image');
                $nameOther=$avatarNameOther;
                    $destinationPathOther = public_path('uploads/cms');
                        $imagePath = $destinationPathOther. "/".  $nameOther;
                        $fileOther->move($destinationPathOther, $nameOther);

                        $cms->update([                 
                            'other_image' => $avatarNameOther,
                        ]);
            }
            $cms->page_name = $request->page_name;
            $cms->slugged_name =  Str::slug($request->page_name,"-");
            $cms->description = $request->page_content;
            $cms->status = 1;
            $cms->update_by = Auth::user()->id;
            $cms->updated_at = date('Y-m-d H:i:s');
            $cms->other_title = $request->other_title;
            $cms->other_description = $request->other_description;
            $cms->save(); 
        }
        elseif($cms->id == 9)
        {
            $formFileNameOther = "other_image";
            $fileFinalNameOther_ar = "";

            if (request()->has('other_image')) 
            {

                $avatarNameOther = time(). rand(1111,
                9999) .'.' .request()->other_image->getClientOriginalExtension();
                $fileOther = request()->file('other_image');
                $nameOther=$avatarNameOther;
                    $destinationPathOther = public_path('uploads/cms');
                        $imagePath = $destinationPathOther. "/".  $nameOther;
                        $fileOther->move($destinationPathOther, $nameOther);

                        $cms->update([                 
                            'other_image' => $avatarNameOther,
                        ]);
            }

            $formFileNameOther1 = "other_image1";
            $fileFinalNameOther1_ar = "";

            if (request()->has('other_image1')) 
            {

                $avatarNameOther1 = time(). rand(1111,
                9999) .'.' .request()->other_image1->getClientOriginalExtension();
                $fileOther1 = request()->file('other_image1');
                $nameOther1=$avatarNameOther1;
                    $destinationPathOther1 = public_path('uploads/cms');
                        $imagePath = $destinationPathOther1. "/".  $nameOther1;
                        $fileOther1->move($destinationPathOther, $nameOther1);

                        $cms->update([                 
                            'other_image1' => $avatarNameOther1,
                        ]);
            }

            $formFileNameOther2 = "other_image2";
            $fileFinalNameOther2_ar = "";

            if (request()->has('other_image2')) 
            {

                $avatarNameOther2 = time(). rand(1111,
                9999) .'.' .request()->other_image2->getClientOriginalExtension();
                $fileOther2 = request()->file('other_image2');
                $nameOther2=$avatarNameOther2;
                    $destinationPathOther2 = public_path('uploads/cms');
                        $imagePath = $destinationPathOther2. "/".  $nameOther2;
                        $fileOther2->move($destinationPathOther2, $nameOther2);

                        $cms->update([                 
                            'other_image2' => $avatarNameOther2,
                        ]);
            }
            $cms->page_name = $request->page_name;
            $cms->slugged_name =  Str::slug($request->page_name,"-");
            $cms->description = $request->page_content;
            $cms->status = 1;
            $cms->update_by = Auth::user()->id;
            $cms->updated_at = date('Y-m-d H:i:s');
            $cms->other_title = $request->other_title;
            $cms->other_highlight = $request->other_highlight;
            $cms->other_description = $request->other_description;
            $cms->other_title1 = $request->other_title1;
            $cms->other_highlight1 = $request->other_highlight1;
            $cms->other_description1 = $request->other_description1;
            $cms->other_title2 = $request->other_title2;
            $cms->other_highlight2 = $request->other_highlight2;
            $cms->other_description2 = $request->other_description2;
            $cms->save();
        }
        else 
        {
            $cms->page_name = $request->page_name;
            $cms->slugged_name =  Str::slug($request->page_name,"-");
            $cms->description = $request->page_content;
            $cms->status = 1;
            $cms->update_by = Auth::user()->id;
            $cms->updated_at = date('Y-m-d H:i:s');
            $cms->save(); 
        }

        return redirect()->route('cms')->with('success', 'CMS updated successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Cms  $cms
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $cms = Cms::find($id); 
        return view('dashboard.cms.show',compact('cms'));
    }

    public function cmsedit(Request $request,$parentId,$langId)
    {

        $cms = Cms::where('parentid','=',$parentId)->where('language_id','=',$langId);
        $iscmsExists = $cms->count();
        $cms_lang = $langId;
        $languageData = Language::find($langId);
        $parentData = Cms::find($parentId);
        $cmsData = [];
        if($iscmsExists>0){
            $cmsData = $cms->first();
            // dd($cmsData->toArray());
        }

        // $except_ids = [2,9,11,13];
        return view('dashboard.cms.addLang',compact('languageData','parentData','cmsData'));
    }

    public function validateRequest($id="")
    {

        if($id !="")
        {
            $validateData =request()->validate([
                'page_name' => 'required',
                'page_content' => 'required',
                'image' => 'mimes:jpeg,jpg,png,gif|max:3072',
                'other_image' => 'mimes:jpeg,jpg,png,gif,svg,mp4,mov,ogg,qt|max:20000',
                'other_description' => 'required',
                'other_title' => 'required',
                'other_highlight' => 'required',
                'other_image1' => 'mimes:jpeg,jpg,png,gif,svg,mp4,mov,ogg,qt|max:20000',
                'other_description1' => 'required',
                'other_title1' => 'required',
                'other_highlight1' => 'required',
                'other_image2' => 'mimes:jpeg,jpg,png,gif,svg,mp4,mov,ogg,qt|max:20000',
                'other_description2' => 'required',
                'other_title2' => 'required',
                'other_highlight2' => 'required',
            ]);

            // if(in_array($id,[2,9,11,13])){
            //     $validateData= request()->validate([
            //         'side_image' => 'mimes:png,jpeg,jpg,gif,svg',
            //         'video' => 'mimes:mp4,mov,ogg,qt|max:20000',
            //         'profile_doc' => 'mimes:png,jpeg,jpg,gif,svg,pdf,doc,docx'
            //     ]);
            // }

        }else{

            $validateData =request()->validate([
                'page_name' => 'required',
                'page_content' => 'required',
            ]);
            
        }

        return $validateData;
    }


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
        $columnSortOrder='';
        if (isset($order_arr[0]['dir']) && $order_arr[0]['dir']!="") {
            $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        }
        $searchValue = $search_arr['value']; // Search value
        if ($columnIndex==0) {
            $sort='cms.id';
        }elseif ($columnIndex==1) {
            $sort='cms.page_name';
        }else{
            $sort='cms.id';
        }

        $sortBy='DESC';
        if ($columnSortOrder!="") {
            $sortBy=$columnSortOrder;
        }


        $totalAr = Cms::where('status','!=',2)->where('parentid','=',0);

       
        if ($searchValue!="") {
            $totalAr = $totalAr->where(function ($query) use ($searchValue) {
                 $query->orWhere('page_name', 'like', '%' . $searchValue . '%');
            });
        }


        $totalRecords = $totalAr->get()->count();

        $totalAr = $totalAr->orderBy($sort,$sortBy)
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr=[];

        foreach ($totalAr as $key => $data) 
        {   
            $cmsshow=  route('cms.show',['id'=>$data->id]);
            $cmsedit =  route('cms.edit',['id'=>$data->id]);
            $options = "";

            // if( \Helper::check_permission(6,1) ){
                $options = '<a class="btn btn-sm show-eyes list box-shadow paddingset" href="'.$cmsshow.'" title="Show"> </a>';
            // }
           
            // if( \Helper::check_permission(6,3) ){
                $options .= '<a class="btn btn-sm success paddingset" href="'.$cmsedit.'" title="Edit"> <small><i class="material-icons">&#xe3c9;</i> </small> </a>';
            // }

            // if(\Helper::check_permission(6,2) && \Helper::check_permission(6,3)){
                $language = Language::where('id',">",'1')->get();
                foreach($language as $k=>$lang) 
                {
                    $langEdit =  route('cms.editCms',[$data->id,$lang->id]);
                    $options .= '<a class="btn" href="'.$langEdit.'" title="'.$lang->title.'">'.strtoupper($lang->code).'</a>';
                }
            // }

            $data_arr[] =array(
            //   "checkbox" => '<label class="ui-check m-a-0"> <input type="checkbox" name="ids[]" value="' . $data->id . '" class="has-value" data-id="' . $data->id . '"><i class="dark-white"></i> <input class="form-control row_no has-value" name="row_ids[]" type="hidden" value="' . $data->id . '"> </label>',
              "name" =>   isset($data->page_name) ? $data->page_name: '',
            //   "description" =>  isset($data->description) ? $data->description : '',
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
                $active  = Cms::wherein('id', $request->ids);
                $active->update(['status' => 1]);
            } elseif ($request->action == "block") {
                Cms::wherein('id', $request->ids)
                    ->update(['status' => 0]);
            } elseif ($request->action == "delete") {

                Cms::wherein('id', $request->ids)
                    ->update(['status' => 2]);
            }
        }else{
            return redirect()->route('cms')->with('errorMessage',__('backend.select_row'));
        }
        return redirect()->route('cms')->with('doneMessage', __('backend.saveDone'));
    }
}
