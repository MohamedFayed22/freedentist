<?php

namespace App\Http\Controllers\backstage;

use App\City;
use App\User;
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

class StaticsController extends Controller
{
    protected $_per_page = 20;

    public function __construct()
    {
        $this->middleware('auth');
        //  $this->middleware('permission')->except('permission','store','update','search');

    }

    public function indexSaudi()
    {
        $users = User::with('city')->where('admin', '=', 2)->where('nationality',194)->orderBy('id','Desc')->paginate(20);
        //	var_dump($users);
        return view('backstage.sicks.indexSaudi', compact('users'))->with('_per_page', $this->_per_page);

    }


}
