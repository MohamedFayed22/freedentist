<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests;
use App\User;
use App\Nationality;
use App\Hospital;
use App\Follower;
use App\Event;

use Auth;
use Session;
use Route;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgetPassword;

class ApiUserController extends Controller
{
	
	 
	public function logout(Request $request) {
  auth('api')->logout();
  return response()->json(['status'=>'Logout successefuly']);
      }
 public function Login(Request $request){
         if(Auth::attempt(['mobile' => $request->mobile,'password' => $request->password , 'admin' => '2', 'active' => '1'])){
            //Auth::user();
            //  Auth::guard('admin')->user();
	           $client = User::where('mobile', $request->mobile)->first();
			   
			DB::table('events')
			
              ->where('user_id', $client->id)
              ->update(['device_id'=>$request->device_id]);
			
			   /* $client = auth()->user();
        $client->api_token = str_random(60);
        $client->save();*/
			
              return response()->json(['status'=>'success','data'=>$client]); 
			//  return $client; 

        }else{
           
             return response()->json(['status'=>'Please enter your login data']);

    }
	}
    public function deleteDevice(Request $request){
       
	/* $dentist = Dentist::where('id', $request->dentis_id)->first();
	
            $dentist->device_id = "";
            
            $dentist->update();*/
			$device_id = "";
			$update=DB::table('events')
			
              ->where('user_id', $request->user_id)
             ->update(['device_id'=>$device_id]);
			//var_dump($update);
           return response()->json(['status'=>'success']);
       
        
	}
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
				
         //       Auth::attempt(['mobile' => $request->mobile,'password' => $request->password ]);
              $message = "Free Dentist - your code ".$result."";
                $msg  = iconv("UTF-8","Windows-1256"  , $message);
                $msg = urlencode($msg);
                $number = $request->mobile;
          //      $url="https://apps.gateway.sa/vendorsms/pushsms.aspx?user=FreeDentist&password=0580580373&msisdn=$number&sid=GW%20Active&msg=$msg&fl=0";
                // echo file_get_contents($url);
  $n = intval(ltrim($number, '0')); // integer
$pfx='966';
  $number = $pfx.$n;
   $url="http://sms.gateway.sa/sendurl.aspx?user=20093022&pwd=058@freedentist.net&senderid=FREEDENTIST&CountryCode=All&msgtext=$msg&mobileno=$number";

                  if(file_get_contents($url)){  
				  //return response()->json(['status'=>'Code send successefuly']);}   
                return response()->json(['data'=>$client,'status'=>'Code send successefuly']);
       
            } }else {
                 return response()->json(['status'=>'Error']);
       
            }
        } else {
             return response()->json(['status'=>'Error']);
       
        }
		  

    }
	
	public function userLoginFTime(Request $request){
         
            //Auth::user();
            //  Auth::guard('admin')->user();
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
			/*  if(Auth::attempt(['mobile' => $client->mobile,'password' => $client->password , 'admin' => '2', 'active' => '1'])){*/
              return response()->json(['status'=>'success','data'=>$client]); 
			//  return $client; 

       // }
		}else{
           
             return response()->json(['status'=>'Please enter your login data']);

    }
	}
	
	public function account(request $request){
        if(!$request->client_id){
           
                 return response()->json(['status'=>'Please login']);

        }
		  $client = User::find($request->client_id);
		  $user = User::where('id',$request->client_id)->first();
	 	 $nationalitys = DB::table('nationalities')
		  
		->where('id',$user->nationality)
			->get();
	
		//$hospitals = Hospital::all();
	    $followers = DB::table('followers')
		->where('user_id',$request->client_id)
		
		->count();
		 return response()->json(['nationalitys'=>$nationalitys,'client'=>$client,'followers'=>$followers,'status'=>'success']);
		 
    }
	
public function forgetPassword2(Request $request)
    {
       


        if (!$request->has('email')){
            return response()->json(['status'=>'Missing Email']);
        }

        $email = $request->input('email');

        $clientEmail = User::where('email', $email)
            ->where('admin',2)
           
            ->first();
        if (!empty($clientEmail)){

         //   $data2 = array();
			 $data2 = new User();
             $data2->email = $email;
            $newPassword = rand("100000","999999");
            $message = "Your Password".$newPassword."";
             $data2->message = $message;

            $data = ['password'=> bcrypt($newPassword)];
            DB::table('users')
                ->where('id', $clientEmail->id)
                ->update($data);
            //Session::flash('success_message', 'تم إرسـال كلمة المرور الجديدة الى بريدك الالكترونى المسجل');
		//	var_dump($users);
			//exit();
			  Mail::to($email)->send(new ForgetPassword($data2));
           
          /* Mail::send('emails.forgetPassword', ['data'=>$data2], function ($message2)  use ($data2){
                $subject = $data2['message'];
                //                 $message->from($request->email, $request->name);
                $message2->to($data2['email'])->subject($subject);
            });*/

            if( count(Mail::failures()) > 0 ) {
                $failuresArr = array();
                foreach(Mail::failures as $email_address) {
                    $failuresArr[] = $email_address;
                }
                return response()->json(['status' => 'Error',  'data' => $failuresArr]);
            } else {
      return response()->json(['status' => 'success', 'data' => $newPassword]);
            }


        } else {
      return response()->json(['status' => 'Email Not found']);
            }


    }
	
  public function forgetPassword(Request $request)
    {
       


        if (!$request->has('mobile')){
            return response()->json(['status'=>'Missing mobile']);
        }

        $mobile = $request->input('mobile');

        $clientEmail = User::where('mobile', $mobile)
             ->where('admin',2)
            ->first();
        if (!empty($clientEmail)){

         //   $data2 = array();
			 $data2 = new User();
             $data2->mobile = $mobile;
            $newPassword = rand("100000","999999");
            $message = "Free Dentist - your new Password  ".$newPassword."";
             $data2->message = $message;

            $data = ['password'=> bcrypt($newPassword)];
            DB::table('users')
                ->where('id', $clientEmail->id)
                ->update($data);
             $msg  = iconv("UTF-8","Windows-1256"  , $message);
                $msg = urlencode($msg);
                $number = $mobile;
        //        $url="https://apps.gateway.sa/vendorsms/pushsms.aspx?user=FreeDentist&password=0580580373&msisdn=$number&sid=GW%20Active&msg=$msg&fl=0";
                // echo file_get_contents($url);

 $n = intval(ltrim($number, '0')); // integer
$pfx='966';
  $number = $pfx.$n;
   $url="http://sms.gateway.sa/sendurl.aspx?user=20093022&pwd=058@freedentist.net&senderid=FREEDENTIST&CountryCode=All&msgtext=$msg&mobileno=$number";
                  if(file_get_contents($url)){ 
				  // return response()->json(['status'=>'Code send successefuly']);}
//                       Session::flash('success_message', 'تم إرسـال كلمة المرور الجديدة الى رقم جوالك');
               
                 return response()->json(['status' => 'success', 'data' => $newPassword]);
       
            } else {
                 return response()->json(['status'=>'Error']);
       
           }


        
}

    }
    
public function profileAction(Request $request){
			
        $client = User::find($request->user_id);

       

        
           $client->name = $request->name;
            $client->email = $request->email;
            $client->mobile = $request->mobile;
            
           
			
        if ($client) {

            $client->update();

             return response()->json(['status'=>'Updated successefuly','data'=>$client]);
        } else {
            return response()->json(['status'=>'Error']);
        }

       

    }
  
}
