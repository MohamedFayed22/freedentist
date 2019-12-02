<?php

namespace App\Http\Controllers\backstage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Hospital;
use App\per_user;
use App\City;
use DB;
use Auth;
use Session;

class HospitalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //  $this->middleware('permission')->except('permission','store','update','search');

    }

    public function index()
    {
        $objects = Hospital::orderBy('id','Desc')->paginate(20);
        return view('backstage.hospitals.index', compact('objects'));

    }

    public function add($id = null)
    {
        $citys = City::get();
        if ($id) {
            $object = Hospital::find($id);
            return view('backstage.hospitals.edit', compact('object', 'citys'));
        }
        return view('backstage.hospitals.edit', compact('citys'));
    }

    public function store(request $request)
    {

        $this->validate($request, [
            'hospital_name_ar' => 'required|string|max:255',
            'hospital_name_en' => 'required|string|max:255',
            'hospital_address_en' => 'required|string|max:255',
            'hospital_address_ar' => 'required|string|max:255',

        ]);
        $hospital = new Hospital;
        $hospital->hospital_name_ar = $request->hospital_name_ar;
        $hospital->hospital_name_en = $request->hospital_name_en;
        $hospital->hospital_address_ar = $request->hospital_address_ar;
        $hospital->hospital_address_en = $request->hospital_address_en;
        $hospital->req_map_location = $request->req_map_location;
        $hospital->city_id = $request->city_id;


        // $user->created_by ='0';
        $hospital->save();
        $request->session()->flash("message", "Hospital added successfully");

        return redirect('/home/hospitals');
    }

    public function update(request $request, $id)
    {
        //dd($request->all());
//        $this->validate($request, [
//            'hospital_name_ar' => 'required|string|max:255',
//            'hospital_name_en' => 'required|string|max:255',
//            'hospital_address_en' => 'required|string|max:255',
//            'hospital_address_ar' => 'required|string|max:255',
//
//        ]);
        $hospital = Hospital::find($id);
        $hospital->hospital_name_ar = (isset($request->hospital_name_ar)) ? $request->hospital_name_ar : $hospital->hospital_name_ar ;
        $hospital->hospital_name_en = (isset($request->hospital_name_en)) ? $request->hospital_name_en : $hospital->hospital_name_en;
        $hospital->hospital_address_ar = (isset($request->hospital_address_ar)) ? $request->hospital_address_ar : $hospital->hospital_address_ar;
        $hospital->hospital_address_en = (isset($request->hospital_address_en)) ? $request->hospital_address_en : $hospital->hospital_address_en;
        $hospital->req_map_location = (isset($request->req_map_location)) ? $request->req_map_location : $hospital->req_map_location;
        $hospital->city_id =(isset($request->city_id)) ? $request->city_id : $hospital->city_id;

        $hospital->update();
        $request->session()->flash("message", "Hospital update successfully");

        return redirect('/home/hospitals');

    }

    public function destroy(Request $request,$id)
    {
        Hospital::find($id)->delete();
        $request->session()->flash("message", "Hospital Deleted ");

        return redirect()->back();
    }
}
