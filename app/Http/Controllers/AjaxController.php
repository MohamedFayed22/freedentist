<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class AjaxController extends Controller
{

    public function selectDentist(Request $request)

    {

        if($request->ajax()){
			//echo $request->hospital_id;
			//exit();
            $dentists = DB::table('dentist_calanders')
    ->join('services', 'dentist_calanders.service_id', '=', 'services.id')
    ->where('dentist_calanders.hospital_id', $request->hospital_id)
	->pluck("services.service_name_en","services.id")
    ->all();
	
            $data = view('ajax-select-2',compact('dentists'))->render();

            return response()->json(['options'=>$data]);

        }

    }

    public function selectDay(Request $request)

    {

        if($request->ajax()){
			//echo $request->hospital_id;
			//exit();
            $days = DB::table('dentist_calanders')
   
    ->where('dentist_calanders.service_id', $request->service_id)
    ->where('dentist_calanders.hospital_id', $request->hospital_id)
	->pluck("dentist_calanders.day","dentist_calanders.day")
    ->all();
	
            $data = view('ajax-day',compact('days'))->render();

            return response()->json(['options'=>$data]);

        }

    }

 public function selectDate(Request $request)

    {

        if($request->ajax()){
            $dates = DB::table('dentist_calanders')
                   ->where('end_date','>',Now())
                   ->where('dentist_calanders.service_id', $request->service_id)
                   ->where('dentist_calanders.hospital_id', $request->hospital_id)
                   ->where('dentist_calanders.status','=',0)
                  ->get();

            $data = view('ajax-date',compact('dates'))->render();
            //$data2 = view('ajax-time',compact('dates'))->render();

            return response()->json(['dates'=>$data]);

        }

    }

 public function selectHospital(Request $request)

    {

        if($request->ajax()){
			//echo $request->hospital_id;
			//exit();
            $hospitals = DB::table('hospitals')
    ->join('cities', 'hospitals.city_id', '=', 'cities.id')
	 ->join('dentist_calanders', 'dentist_calanders.hospital_id', '=', 'hospitals.id')
	  ->where('dentist_calanders.service_id', $request->service_id)
    ->where('cities.id', $request->city_id)
	->pluck("hospitals.hospital_name_ar","hospitals.id")
    ->all();
	
            $data = view('ajax-select-hospital',compact('hospitals'))->render();

            return response()->json(['options'=>$data]);

        }

    }

public function selectCity(Request $request)

    {

        if($request->ajax()){
			//echo $request->hospital_id;
			//exit();
            $cities = DB::table('dentist_calanders')
    ->join('hospitals', 'dentist_calanders.hospital_id', '=', 'hospitals.id')
    ->join('cities', 'hospitals.city_id', '=', 'cities.id')
    ->where('dentist_calanders.service_id', $request->service_id)
	->pluck("cities.city_name_ar","cities.id")
    ->all();
	
            $data = view('ajax-select-city',compact('cities'))->render();

            return response()->json(['options'=>$data]);

        }

    }

}