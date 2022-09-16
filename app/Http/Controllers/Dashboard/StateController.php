<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Label;
use App\Models\Language;
use App\Models\Country;
use App\Models\State;
use Auth;
use File;
use Illuminate\Config;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Redirect;
use DB;
use Session;
use Throwable;
use App\Models\Setting;
use Illuminate\Validation\Rule;
use Yajra\Datatables\Datatables;
use Illuminate\Support\MessageBag;

class StateController extends Controller
{
    protected $flag_image_uri = "";
    protected $flag_not_found_uri = "";
    protected $no_flag_image = "";

    public function __construct()
    {
        $this->middleware('auth');
        $this->setFlagImagePath();
        $this->flag_not_found_uri = asset('assets/dashboard/images/no_image.png');
        $this->no_flag_image = asset('assets/dashboard/images/flags.jpg');
    }

    public function getFlagImagePath(){
        return asset('assets/dashboard/images/flags');
    }

    public function setFlagImagePath(){
        $this->flag_image_uri = $this->getFlagImagePath();
    }

    /**
     * Display a listing of the resource.
     * string $stat
     * @return \Illuminate\Http\Response
     */

    public function index()
    {        
        $state = [];
        $state['state_list'] = State::with(['Country'])->where('status','!=','2')->get();
        return view("dashboard.state.list",$state);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $id = decrypt($id);
        $state = State::with(['Country'])->find($id);
        return view('dashboard.state.show', compact('state'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \Illuminate\Http\Request $webmasterId
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $country_list['country'] =  Country::where('status',"1")->get();
        return view("dashboard.state.create",$country_list);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function validateRequest($request,$id="",$lang_id = "",$childId="")
    {
        $validation_messages = [
            'state_name.required' => 'State Name is required.',
            'state_name.unique' => 'State Name is already taken.',
            'state_name.encoded_unique' => 'State Name is already taken.',
            'state_name.string' => 'Only string allowed',
            'state_name.max' => 'Max length exceeded',
            'country.required' => 'Country is required.',
        ];

        if($id !="" && empty($childId))
        {
            $validator = Validator::make($request->all(), [
                'state_name' => [
                                    'required',
                                    'string',
                                    'max:30',
                                    'encoded_unique:states,name,id,'.$id.',status,2'
                                ],
                'country' => [
                                    'required',
                                ],
            ],
            $validation_messages
        );

        }else{
            $validator = Validator::make($request->all(), [
                'state_name' => [
                                    'required',
                                    'string',
                                    'max:30',
                                    'encoded_unique:states,name,status,2'
                                ],
                                'country' => [
                                    'required',
                                ],
            ],
            $validation_messages
        );
            
        }

        return $validator;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
        $state = new State();
        $validations = $this->validateRequest($request);

        if ($validations->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validations)
                        ->withInput();
        }

        $state->name = urlencode($request->state_name);
        $state->country_id = $request->country;
        $state->status = '1';
        $state->save(); 

        return redirect()->route('state')->with('doneMessage', __('backend.addDone'));
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
        $state = State::find($id);
        $country_list =  Country::where('status',"1")->get();
        if($state->count() > 0){
            return view('dashboard.state.edit', compact('state','country_list'));
        }else{
            return redirect()->route('country')->with('errorMessage', __('backend.noDataFound'));
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
        $state = State::find($id);
        $state->name = urlencode($request->state_name);
        $state->country_id = $request->country;
        $state->save(); 

        return redirect()->route('state')->with('success', __('backend.saveDone'));
    }


    // public function multiLang(Request $request,$parentId,$langId){
    //     $country = Country::where('parent_id','=',$parentId)->where('language_id','=',$langId);
    //     $isCountryExists = $country->count();
    //     $country_lang = $langId;
    //     $languageData = Language::find($langId);
    //     $parentData = Country::find($parentId);
    //     $countryData = [];
    //     if($isCountryExists>0){
    //         $countryData = $country->first();
    //     }
    //     return view('dashboard.country.addLang',compact('languageData','parentData','countryData'));
    // }

    // public function storeLang(Request $request){

    //     $validations = $this->validateRequest($request,"",$request->country_language_id,$request->country_id);
    //     if ($validations->fails()) {
    //         return redirect()
    //                     ->back()
    //                     ->withErrors($validations)
    //                     ->withInput();
    //     }
    //     $parentData = Country::find($request->country_parent_id);
    //     $newUser = Country::updateOrCreate([
    //         'language_id' =>  (int) $request->country_language_id,
    //         'parent_id' =>  (int) $parentData->id,
    //     ],[
    //         'name' => urlencode($request->country_name),
    //         'status' =>  1
    //     ]);
    //     return redirect()->route('country')->with('success', __('backend.saveDone'));
    // }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $state = State::find($id);
        $state->status = 2;
        $state->save();
        
        return redirect()->route('state')
            ->with('success', __('backend.deleteDone'));
    }


    public function updateAll(Request $request)
    {
        if ($request->row_ids != "") {
            if ($request->action == "activate") {
                $active  = State::wherein('id', $request->ids);
                $active->update(['status' => '1']);
            } elseif ($request->action == "block") {
                State::wherein('id', $request->ids)
                    ->update(['status' => '0']);
            } elseif ($request->action == "delete") {
                State::wherein('id', $request->ids)
                    ->update(['status' => '2']);
            }
        }
        return redirect()->route('state')->with('doneMessage', __('backend.saveDone'));
    }


  

}
