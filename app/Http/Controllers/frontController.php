<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;

use Auth;
use DB;
use Session;
use Validator;
use Input;
use Calendar;
use App\Event;
use App\User;
use App\Dentist;
use App\Follower;
use App\Treatment;
use App\Service;
use App\Hospital;
use App\City;
use App\Setting;
use App\Page;
//use Illuminate\Support\Facades\Session;


class frontController extends Controller
{
    
    public function index()
    {


       $this->data['cities']=City::all();
       $this->data['hospitals']=Hospital::all();
		 $this->data['followers']=Follower::all();
		 $this->data['services']=Service::all();
		 $this->data['dentists']=Dentist::all();
		 


       return view('index',$this->data);

    }


  
    public function aboutUs(){

        $sets = array();
        $settings = Setting::all();
        foreach ($settings as $set)
        {
            $sets[$set->setting_name] = $set->setting_value;
        }

        $aboutus = Page::where('page_id',1)->first();
       

        return view('frontend/about')->with(['aboutus'=>$aboutus ,  'sets'=>$sets]);

    }

 public function Privacy(){

        $sets = array();
        $settings = Setting::all();
        foreach ($settings as $set)
        {
            $sets[$set->setting_name] = $set->setting_value;
        }

        $aboutus = Page::where('page_id',2)->first();
       

        return view('frontend/privacy')->with(['aboutus'=>$aboutus ,  'sets'=>$sets]);

    }
    public function terms(){

        $sets = array();
        $settings = Setting::all();
        foreach ($settings as $set)
        {
            $sets[$set->setting_name] = $set->setting_value;
        }

        $aboutus = Page::where('page_id',7)->first();
       

        return view('frontend/terms')->with(['aboutus'=>$aboutus ,  'sets'=>$sets]);

    }

}
