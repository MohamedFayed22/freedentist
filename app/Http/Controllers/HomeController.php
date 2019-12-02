<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\Hospital;
use App\Dentist;
use App\Dentist_calander;
use App\User;
use App\Offer;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $service = Service::all()->count();
        $hospital = Hospital::all()->count();
        $dentist = Dentist::all()->count();
        $dentist_calander = Dentist_calander::all()->count();
        $usersSud = User::with('city')->where('admin', '=', 2)->where('nationality',194)->count();
        $offer = Offer::all()->count();

        return view('home');
    }
}
