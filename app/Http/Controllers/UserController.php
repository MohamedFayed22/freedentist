<?php

namespace App\Http\Controllers;
 

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests;
use App\User;
use App\URL;
use App\Nationality;
use App\Hospital;
use App\Follower;
use \Validator;
use Auth;
use Session;
use Route;
use Carbon\Carbon;
use DB;

class UserController extends Controller
{
	
	
	
	protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
	 public function showLoginForm(){
        if(Auth::guard('client')->check()){
		
           // return redirect('/clientDashboard');
        }
if (session('link')) {
        $myPath     = session('link');
         $loginPath  = url('/cLogin');
        $previous   = url()->previous();
	 $link=url('dLogin');
	 $link2=url('ActiveLogin');
	 $myPath2=url('clientDashboard');
	// echo   session('link');
//exit();
        if ($previous == $loginPath  ) {
            session(['link' => $myPath]);
        }
        else{
            session(['link' => $previous]);
	 
        }if($previous==$link or $previous==$link2){
			 session(['link' => $myPath2]);
		}
    }
    else{
         session(['link' => url()->previous()]);
    }
       
 //session(['link' => url()->previous()]);
        return view('client.login');
    }
	public function logout(Request $request) {
  auth('client')->logout();
   return redirect()->to('/clientDashboard');
      }
 public function Login(Request $request){
         if(Auth::guard('client')->attempt(['mobile' => $request->mobile,'password' => $request->password , 'admin' => '2', 'active' => '1'])){
            //Auth::user();
            //  Auth::guard('admin')->user();
	//return redirect()->intended();
	//return redirect()->back();
          //  return redirect()->to('/clientDashboard');
		    return redirect(session('link')); 
        }else{
           
             $loginerror = "يجب التأكد من البيانات المدخلة";
            return view('client.login',compact('loginerror'));
    }
	}
   public function showRegisterForm()
    {
		$nationalitys = Nationality::all();
		
			//echo	$client_id = Auth::guard('client')->user()->name;
      return view('client.register')->with(['nationalitys'=>$nationalitys]);
    }//
	public function registerAction(Request $request){
		 $user_check = User::where('mobile', $request->mobile)
		 ->where('active', 0)->first();
	if($user_check){
		User::where('mobile', $request->mobile)
		 ->where('active', 0)->first()->delete();
	}
      $this->validate($request,
            [
                'name' => 'required|string|max:255',
                
                'mobile'     => 'required|numeric|regex:/(05)[0-9]{8}/|unique:users',
                'email'      => 'required|string|email|max:255|unique:users',
                'password'   => 'required|string|min:6|confirmed',
				'birthdate' => 'required|date'


            ]);

/*dd($request->all()); 
exit();*/
        if ($request->password === $request->password_confirmation) {
            $result = '';
   for($i = 0; $i < 4; $i++) {
   	 $result .= mt_rand(0, 9);
   }
 //  $result='1234';
            $client = User::create([
                'name'    => $request->name,
                
                'email'         => $request->email,
                'mobile'        => $request->mobile,
                'nationality'        => $request->nationality,
                'birthdate'        => Carbon::parse($request->birthdate)->format('Y-m-d'),
                'gender'        => $request->gender,
                'admin'        => 2,
                'otp'        => $result,
                'password'      => bcrypt($request->password),
				'api_token' => Str::random(60),
               
            ]);
            
            if ($client) {
				
             //   Auth::guard('client')->attempt(['mobile' => $request->mobile,'password' => $request->password ]);
                 $message = "Free Dentist - your code ".$result."";
                $msg  = iconv("UTF-8","Windows-1256"  , $message);
                $msg = urlencode($msg);
                $number = $request->mobile;
              //  $number = (int)$number;
$n = intval(ltrim($number, '0')); // integer
$pfx='966';
  $number = $pfx.$n;
             //   $url =  "http://sms.rasaelna.com/gw/?userName=Mohammed&userPassword=123456mm&numbers=$number&userSender=FUDEX-AD&msg=$msg&By=API";
            //   $url="https://apps.gateway.sa/vendorsms/pushsms.aspx?user=FreeDentist&password=0580580373&msisdn=$number&sid=GW%20Active&msg=$msg&fl=0";
 // $url="http://sms.gateway.sa/sendurlcomma.aspx?user=20093022&pwd=058@freedentist.net&senderid=FREEDENTIST&mobileno=$number&msgtext=$msg";
  $url="http://sms.gateway.sa/sendurl.aspx?user=20093022&pwd=058@freedentist.net&senderid=FREEDENTIST&CountryCode=All&msgtext=$msg&mobileno=$number";

                // echo file_get_contents($url);


                  if(file_get_contents($url)){ 
              //  Session::flash('message', "تم التسجيل بنجاح");

               return redirect('/ActiveLogin');
            }} else {
                $error_message = (app()->getLocale()=='en') ? "Failed send " : "حدث خطأ أثناء التسجيل. برجاء المحاولة مرة أخرى";
                Session::flash('message', $error_message);

                return redirect()->back();
            }
        } else {
           $error_message = (app()->getLocale()=='en') ? "Password and password confirmation do not match " : "كلمة والمرور وتأكيد كلمة المرور غير متطابقان";
                Session::flash('message', $error_message);

            return redirect()->back();
        }
		  

    }
	 public function ActiveLoginform()
    {
		
			//echo	$client_id = Auth::guard('client')->user()->name;
       $loginerror = "";
            return view('client.active',compact('loginerror'));
    }//
	public function userLoginFTime(Request $request){
         
            //Auth::user();
            //  Auth::guard('admin')->user();
		//	echo $request->otp;
			$this->validate($request,
            [
               
               
                'otp'   => 'required|numeric',
				
            ]);
	           $client = User::where('otp', $request->otp)->where('admin', 2)->first();
			   if($client){
			   	 $client->active = 1;
            
           $client->update();
		  
			   				   /* $client = auth()->user();
        $client->api_token = str_random(60);
        $client->save();*/
			 
               Session::flash('message', "تم التسجيل بنجاح");
 Auth::guard('client')->login($client);
               return redirect('/clientDashboard');

        }else{
            $loginerror = "يجب التأكد من البيانات المدخلة";
            return view('client.active',compact('loginerror'));
    }
	}
	
	
	public function account(){
        if(!Auth::guard('client')->check()){
            return redirect('cLogin');
			
        }
		  $client = User::find(Auth::guard('client')->user()->id);
	 	$nationalitys  = Nationality::all();
	
		$hospitals = Hospital::all();
	    $followers = DB::table('followers')
		->where('user_id',Auth::guard('client')->user()->id)
		
		->count();
		 $Allfollowers = DB::table('followers')
		->where('user_id',Auth::guard('client')->user()->id)
		
		->get();
		 return view('frontend.client.account')->with(['nationalitys'=>$nationalitys,'client'=>$client,'hospitals'=>$hospitals,'followers'=>$followers,'Allfollowers'=>$Allfollowers]);
		
    }
	 public function profile(){
        if(!Auth::guard('client')->check()){
            return redirect('cLogin');
			
        }
		  $client = User::find(Auth::guard('client')->user()->id);
	 	$nationalitys  = Nationality::all();
		 return view('frontend.client.profile')->with(['nationalitys'=>$nationalitys,'client'=>$client]);
		
    }
        public function profileAction(Request $request){
			
        $client = User::find(Auth::guard('client')->user()->id);

        $this->validate($request, [
             'name' => 'required|string|max:255',
                'birthdate' => 'required|date'

               
        ]);
        if ($request->password) {
            $this->validate($request, [
                'password' => 'required|string|min:6|confirmed',
            ]);
        }

        if ($request->email != $request->old_email) {
            $this->validate($request, [
                'email' => 'required|string|email|max:255|unique:users',
            ]);
        }
        if ($request->mobile != $request->old_mobile) {
            $this->validate($request, [
                'mobile' => 'required|numeric|unique:users',
            ]);
        }

        $client->name = $request->name;
        $client->gender = $request->gender;
        $client->nationality = $request->nationality;
        if ($request->password) {
            $client->password = bcrypt($request->password);
        }
        $client->email = $request->email;
        $client->mobile = $request->mobile;
        $client->birthdate =Carbon::parse($request->birthdate)->format('Y-m-d');
        
        if ($client->admin == 2) {

            $client->update();
 $message = (app()->getLocale()=='en') ? "successfully Added" : "تم التسجيل بنجاح";
                Session::flash('message', $message);



           
        } else {
			$message = (app()->getLocale()=='en') ? "Failed send " : "لا يمكن تعديل بيانات هذا الحساب";
                Session::flash('message', $error_message);


           
        }

        return redirect('/profile');

    }
public function showRegisterFollower()
    {
		$nationalitys = Nationality::all();
		
			//echo	$client_id = Auth::guard('client')->user()->name;
      return view('client.registerFollower')->with(['nationalitys'=>$nationalitys]);
    }//
	public function registerActionFollower(Request $request){
		 if(!Auth::guard('client')->check()){
            return redirect('cLogin');
        }
        $this->validate($request,
            [
                'name' => 'required|string|max:255',
                'birthdate' => 'required|date',

                'relation'     => 'required|string|max:255',
               
            ]);
 
 //  exit();
           $client = User::find(Auth::guard('client')->user()->id);
 if ($client) {
 
            $Newclient = Follower::create([
                'name'    => $request->name,
                
                'relation'         => $request->relation,
                'user_id'        => Auth::guard('client')->user()->id,
                'nationality'        => $request->nationality,
                'birthdate'        => Carbon::parse($request->birthdate)->format('Y-m-d'),
                'gender'        => $request->gender,
                'mobile'        => $client->mobile,
                'email'        => $client->email,
                'password'        => $client->password,
                
                'admin'        => 2,
                
                
               
            ]);
            }
            if ($Newclient) {
				
               
                
                $message = (app()->getLocale()=='en') ? "successfully Added" : "تم التسجيل بنجاح";
                Session::flash('message', $message);



               return redirect('/clientDashboard');
            } else {
				 $error_message = (app()->getLocale()=='en') ? "Failed send " : "حدث خطأ أثناء التسجيل. برجاء المحاولة مرة أخرى";
                Session::flash('message', $error_message);


                
                return redirect()->back();
            }
        
		  

    }
	
	public function forgetPasswordU(){

        if (Auth::guard('client')->check()){
            return redirect('/');
        }

        return view('client.forget_password');
    }
	public function forgetPasswordActionU(Request $request)
    {
       
if (Auth::guard('dentist')->check()){
            return redirect('/');
        }
 

        
        if (!$request->has('mobile')){
          $this->validate($request,[
                'mobile' => 'required'
            ]);
        }

        $mobile = $request->input('mobile');

        $clientEmail = User::where('mobile', $mobile)
            
            ->first();
         //   var_dump($clientEmail);
         //   exit();
        if (!empty($clientEmail)){

         //   $data2 = array();
			 $data2 = new User();
             $data2->mobile = $mobile;
            $newPassword = rand("100000","999999");
            $message = "Free Dentist - your new Password ".$newPassword."";
             $data2->message = $message;

            $data = ['password'=> bcrypt($newPassword)];
            DB::table('users')
                ->where('id', $clientEmail->id)
                ->update($data);
               $msg  = iconv("UTF-8","Windows-1256"  , $message);
                $msg = urlencode($msg);
                $number = $mobile;
           //      $url="https://apps.gateway.sa/vendorsms/pushsms.aspx?user=FreeDentist&password=0580580373&msisdn=$number&sid=GW%20Active&msg=$msg&fl=0";
  
 $n = intval(ltrim($number, '0')); // integer
$pfx='966';
  $number = $pfx.$n;
   $url="http://sms.gateway.sa/sendurl.aspx?user=20093022&pwd=058@freedentist.net&senderid=FREEDENTIST&CountryCode=All&msgtext=$msg&mobileno=$number";

            if(file_get_contents($url)){
				 $message = (app()->getLocale()=='en') ? "successfully send code to your mobile" : "تم بنجاح ارسال الرقم السري الى رقم الجوال";
                Session::flash('message', $message);
 
			// $request->session()->flash("message", "تم بنجاح ارسال الرقم السري الى البريد الالكتروني");
	   return redirect('cLogin');
              
            } else {
      
	   $error_message = (app()->getLocale()=='en') ? "Failed send code to your mobile" : "فشل ارسال ";
                Session::flash('message', $error_message);
	 // $request->session()->flash("error_message", "فشل ارسال البريد الالكتروني");
return redirect('cLogin');
            }


        } else {
			$error_message = (app()->getLocale()=='en') ? "No mobile found" : "لا بوجد موبيل ";
                Session::flash('message', $error_message);
     // $request->session()->flash("error_message", $error_message);
 return redirect('cLogin');
            }


    }
	/*function generateotp($len) {
   $result = '';
   for($i = 0; $i < $len; $i++) {
   $result .= mt_rand(0, 9);
   }
   return $result;
   }
   $otp= generateotp(6);
   http://xyz.xyz/api/send?user=id&apikey=apikey&sndr=GW Active&mobile=mobile&text=$otp

   */
        
}
