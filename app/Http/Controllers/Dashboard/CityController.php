<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Label;
use App\Models\Language;
use App\Models\Country;
use App\Models\City;
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

class CityController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {        
        $city = [];
        $city['city_list'] = City::with(['Country','State'])->where('status','!=','2')->get();
        return view("dashboard.city.list",$city);
    }


    public function show($id)
    {
        $id = decrypt($id);
        $city = city::with(['Country','State'])->find($id);
        return view('dashboard.city.show', compact('city'));
    }

   
    public function create()
    {
        $country_list['country'] =  Country::where('status',"1")->get();
        return view("dashboard.city.create",$country_list);
    }


    public function validateRequest($request,$id="",$lang_id = "",$childId="")
    {
        $validation_messages = [
            'city_name.required' => 'City Name is required.',
            'city_name.unique' => 'City Name is already taken.',
            'city_name.encoded_unique' => 'City Name is already taken.',
            'city_name.string' => 'Only string allowed',
            'city_name.max' => 'Max length exceeded',
            'country.required' => 'Country is required.',
        ];

        if($id !="" && empty($childId))
        {
            $validator = Validator::make($request->all(), [
                'city_name' => [
                                    'required',
                                    'string',
                                    'max:30',
                                    'encoded_unique:cities,name,id,'.$id.',status,2'
                                ],
                'state' => [
                                    'required',
                                ],
            ],
            $validation_messages
        );

        }else{
            $validator = Validator::make($request->all(), [
                'city_name' => [
                                    'required',
                                    'string',
                                    'max:30',
                                    'encoded_unique:cities,name,status,2'
                                ],
                                'state' => [
                                    'required',
                                ],
            ],
            $validation_messages
        );
            
        }

        return $validator;
    }

    public function store(Request $request)
    {       
        $city = new City();
        $validations = $this->validateRequest($request);

        if ($validations->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validations)
                        ->withInput();
        }

        $city->name = urlencode($request->city_name);
        $city->state_id = $request->state;
        $city->country_id = $request->country;
        $city->status = '1';
        $city->save(); 

        return redirect()->route('city')->with('doneMessage', __('backend.addDone'));
    }

    public function edit($id)
    {
        $id = decrypt($id);
        $city = city::with(['State'])->find($id);
        $country_list =  Country::where('status',"1")->get();
        $state =  State::where('status',"1")->where('country_id',$city->country_id)->get();
        if($city->count() > 0){
            return view('dashboard.city.edit', compact('city','country_list','state'));
        }else{
            return redirect()->route('state')->with('errorMessage', __('backend.noDataFound'));
        }
    }

    public function update(Request $request,$id)
    {
        $validations = $this->validateRequest($request,$id);
        if ($validations->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validations)
                        ->withInput();
        }
        $city = City::find($id);
        $city->name = urlencode($request->city_name);
        $city->country_id = $request->country;
        $city->state_id = $request->state;
        $city->save(); 

        return redirect()->route('city')->with('success', __('backend.saveDone'));
    }

    public function destroy($id)
    {
        $city = City::find($id);
        $city->status = 2;
        $city->save();
        
        return redirect()->route('city')
            ->with('success', __('backend.deleteDone'));
    }


    public function updateAll(Request $request)
    {
        if ($request->row_ids != "") {
            if ($request->action == "activate") {
                $active  = City::wherein('id', $request->ids);
                $active->update(['status' => '1']);
            } elseif ($request->action == "block") {
                City::wherein('id', $request->ids)
                    ->update(['status' => '0']);
            } elseif ($request->action == "delete") {
                City::wherein('id', $request->ids)
                    ->update(['status' => '2']);
            }
        }
        return redirect()->route('city')->with('doneMessage', __('backend.saveDone'));
    }

    public function getState(Request $request)
    {
        $state = State::where('status',"1")->where('country_id',$request->id)->select('name','id')->get()->toArray();
        $data_arr = [];
        if(!empty($state)){
            $data_arr[] = "<option>Select state</option>";
            foreach ($state as $key => $value) {
                $data_arr[] = "<option value='".$value['id']."'>".urldecode($value['name'])."</option>";
            }
        }else{
            $data_arr[] = "<option>No data</option>";
        }
        echo json_encode($data_arr);
    }

    public function getCity(Request $request)
    {
        $city = City::where('status',"1")->where('state_id',$request->id)->where('country_id',$request->id)->select('name','id')->get()->toArray();
        $data_arr = [];
        if(!empty($city)){
            $data_arr[] = "<option>Select city</option>";
            foreach ($city as $key => $value) {
                $data_arr[] = "<option value='".$value['id']."'>".urldecode($value['name'])."</option>";
            }
        }else{
            $data_arr[] = "<option>No data</option>";
        }
        echo json_encode($data_arr);
    }
  

}
