<?php

namespace App\Http\Controllers\backstage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;



class UserController extends Controller {

    public function __construct(){

    }

    public function login(){
        if (Auth::guard('web')->check() && in_array(Auth::guard('web')->user()->admin,[0,1])){
            return redirect('/home');
        }
        return view('backstage.users.login');
//        else{
//            $error = "يجب التأكد من البيانات المدخلة";
//            return view('backstage.users.login',compact('error'));
//        }

    }


    public function logout(Request $request){
        Auth::guard('web')->logout();
        return redirect('/login');
    }

    public function actionLogin(Request $request){
        if(Auth::guard('web')->attempt(['email' => $request->email,'password' => $request->password , 'admin' => '0'] ) || Auth::guard('web')->attempt(['email' => $request->email,'password' => $request->password , 'admin' => '1'] )){
            //Auth::user();
            //  Auth::guard('admin')->user();
            return redirect()->to('/home');
        }else{
            $error = "يجب التأكد من البيانات المدخلة";
            return view('backstage.users.login',compact('error'));
        }
    }

}
