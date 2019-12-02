<?php

namespace App\Http\Controllers\backstage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\per_user;
use DB;
use Auth;
use Session;

class membersController extends Controller
{
    protected  $_per_page = 20;
        public function __construct()
        {
            $this->middleware('auth');
          //  $this->middleware('permission')->except('permission','store','update','search');

        }

    public function index()
        {
            $objects = User::where('admin', '=', 1)->orWhere('admin', '=', 0)->orderBy('id','Desc')->paginate($this->_per_page);
            return view ('backstage.users.index',compact('objects'))->with('_per_page',$this->_per_page);

        }
        public function add($id=null){
            if($id)
            {
                $auser=User::find($id);
                return view('backstage.users.edit',compact('auser'));
            }
            return view ('backstage.users.edit');
        }
        public function store(request $request)
        {
            $this->validate($request,[
                'name' => 'required|string|max:255',
                'mobile' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
                'photo' =>'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->mobile = $request->mobile;
            $user->admin =0;
            if($request->photo)
            {
                $name = time().'.'.$request->photo->getClientOriginalExtension();
                $request->photo->move(public_path('/images'),$name);
                $user->photo = $name;
            }
           // $user->created_by ='0';
            $user->save();
            $request->session()->flash("message", "Member added successfully");


            return redirect('/home/users');
        }
    public function update(request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
            
            'mobile' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'photo' =>'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        ]);
        $user = User::find($id);
        $user->name = $request->name;
       
        $user->password = bcrypt($request->password);
        $user->mobile = $request->mobile;
        $user->admin = 0;
        if($request->photo)
        {
            $name = time().'.'.$request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('/images'),$name);
            $user->photo = $name;
        }
        $user->update();
        $request->session()->flash("message", "Member Edit successfully");

        return redirect('/home/users');

    }
    public function destroy($id)
    {
        User::find($id)->delete();
        Session::flash("message", "Member Delete " );

        return redirect()->back();
    }
    public function search(request $request)
    {
        $objects= User::where('name','LIKE','%'.$request->user_s.'%')
          
           ->orwhere('email','LIKE','%'.$request->user_s.'%')
            ->orwhere('mobile','LIKE','%'.$request->user_s.'%')->paginate($this->_per_page);
        return view('backstage.users.index',compact('objects'))->with('_per_page',$this->_per_page);

    }
    public function permission(request $request)
    {
      per_user::where('user_id',$request->user_id)->delete();

      foreach ($request as $k => $v) {
        if($k == 'user_id'||$k == '_token')
        {
          continue;
        }

        $per_user = new per_user;
        $per_user->permission_id = $v;
        $per_user->user_id = $request->user_id;
        $per_user->save();
      }
      Session::flash("message", "تم اضافة الصلاحيات" );

      return redirect()->back();

    }
}
