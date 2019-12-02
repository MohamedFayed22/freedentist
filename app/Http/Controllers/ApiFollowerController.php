<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Nationality;
use App\Follower;

use Auth;
use Session;
use Route;
use Carbon\Carbon;
use DB;
class ApiFollowerController extends Controller
{
	

	
		

	public function registerActionFollower(Request $request){
		 if(!$request->client_id){
            return response()->json(['status'=>'Please login']);
       
        }
        $this->validate($request,
            [
                'name' => 'required|string|max:255',
                
                'relation'     => 'required|string|max:255',
               
            ]);

           $client = User::find($request->client_id);
 if ($client) {
            $Newclient = Follower::create([
                'name'    => $request->name,
                
                'relation'         => $request->relation,
                'user_id'        => $request->client_id,
                'nationality'        => $request->nationality,
                'birthdate'        => Carbon::parse($request->birthdate)->format('Y-m-d'),
				
                'gender'        => $request->gender,
             
                
                
               
            ]);
            }
            if ($Newclient) {
				
               
                
            return response()->json(['status'=>'تم اضافة تابع بنجاح']);
       

              
            } else {
                 return response()->json(['status'=>'حدث خطأ ما']);
       
            }
        
		  

    }
        
	public function getFollower(Request $request,$id){
		

			 
          $followers=DB::table('followers')
			
              ->where('user_id', $id)
			  ->get();

            if ($followers) {
				
               
                
            return response()->json(['status'=>'sucess','followers'=>$followers]);
       

              
            } else {
                 return response()->json(['status'=>'Not found followers']);
       
            }
        
		  

    }	
}
