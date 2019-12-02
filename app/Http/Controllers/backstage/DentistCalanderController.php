<?php

namespace App\Http\Controllers\backstage;

use App\Dentist_calander;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Dentist;
use App\Event;
use DB;
use App\Nationality;
use App\Hospital;
use Auth;
use Session;
use Carbon\Carbon;

class DentistCalanderController extends Controller
{
    protected $_per_page = 20;

    public function __construct()
    {
        $this->middleware('auth');
        //  $this->middleware('permission')->except('permission','store','update','search');

    }

    public function index()
    {
        $objects = Dentist_calander::with('dentist','hospital','service')->orderBy('dentist_id','Desc')->paginate(20);
       // dd($objects);
        return view('backstage.dentists.calendars', compact('objects'))->with('_per_page', $this->_per_page);

    }
}
