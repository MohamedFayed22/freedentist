<?php

namespace App\Http\Controllers\backstage;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\User;
use App\per_user;
use DB;
use Auth;
use Session;
use App\Nationality;
use Carbon\Carbon;
use App\City;


class SickController extends Controller
{
    protected $_per_page = 20;

    public function __construct()
    {
        $this->middleware('auth');
        //   $this->middleware('permission')->except('permission','store','update','search');

    }

    public function index()
    {
        $users = User::with('city')->where('admin', '=', 2)->orderBy('id','Desc')->paginate(20);
        //	var_dump($users);
        return view('backstage.sicks.index', compact('users'))->with('_per_page', $this->_per_page);

    }

    public function add($id = null)
    {
        $cities = City::all();
        $nationalitys = Nationality::all();
        if ($id) {
            $auser = User::find($id);

            return view('backstage.sicks.edit')->with(['nationalitys' => $nationalitys, 'auser' => $auser,'cities'=>$cities]);

        }
        return view('backstage.sicks.edit')->with(['nationalitys' => $nationalitys,'cities'=>$cities]);

    }

    public function store(request $request)
    {
        $this->validate($request,
            [
                'name' => 'required|string|max:255',
                'mobile' => 'required|numeric|regex:/(05)[0-9]{8}/|unique:users',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
                'birthdate' => 'required|date'

            ]);


        $result = '';
        for ($i = 0; $i < 9; $i++) {
            $result .= mt_rand(0, 9);
        }
        $user = new User;
        $user->name = $request->name;

        $user->email = $request->email;
        $user->city_id = $request->city;

        $user->password = bcrypt($request->password);

        $user->mobile = $request->mobile;
        $user->admin = 2;
        $user->active = 1;
        $user->nationality = $request->nationality;
        $user->gender = $request->gender;
        $user->otp = $result;
        $user->api_token = Str::random(60);
        $user->birthdate = Carbon::parse($request->birthdate)->format('Y-m-d');

        // $user->created_by ='0';
        $user->save();
        $request->session()->flash("message", "Sick added successfully");

        return redirect('/home/sicks');
    }

    public function update(request $request, $id)
    {

        $user = User::find($id);
        $user->name =  (isset($request->name)) ? $request->name : $user->name ;
        $user->email = (isset($request->email)) ? $request->email : $user->email ;

        if ($request->password) {
           
             $user->password = bcrypt($request->password);

        }
        $user->mobile = (isset($request->mobile)) ? $request->mobile : $user->mobile;
        $user->admin = 2;
        
         $user->city_id = $request->city;

        $user->nationality = (isset($request->nationality)) ? $request->nationality : $user->nationality;

        $user->gender =  (isset($request->gender)) ? $request->gender : $user->gender;

        $user->birthdate = Carbon::parse($request->birthdate)->format('Y-m-d');

        $user->update();
        $request->session()->flash("message", "Sick edited successfully");

        return redirect('/home/sicks');

    }

    public function destroy($id)
    {
        User::find($id)->delete();
        Session::flash("message", "Sick Deleted");

        return redirect()->back();
    }

    public function search(request $request)
    {
        $users = User::where('name', 'LIKE', '%' . $request->user_s . '%')
            ->orwhere('email', 'LIKE', '%' . $request->user_s . '%')
            ->orwhere('mobile', 'LIKE', '%' . $request->user_s . '%')->paginate($this->_per_page);
        return view('backstage.sicks.index', compact('users'))->with('_per_page', $this->_per_page);

    }

}
