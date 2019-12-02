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
class FollowerController extends Controller
{
	

	
	 public function index()
        {
			if(!Auth::guard('client')->check()){
            return redirect('cLogin');
        }
            $objects = Follower::where('user_id',Auth::guard('client')->user()->id)->get();
            return view ('client.followers',compact('objects'));

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
                
                'relation'     => 'required|string|max:255',
               
            ]);

           $client = User::find(Auth::guard('client')->user()->id);
 if ($client) {
            $Newclient = Follower::create([
                'name'    => $request->name,
                
                'relation'         => $request->relation,
                'user_id'        => Auth::guard('client')->user()->id,
                'nationality'        => $request->nationality,
                'birthdate'        => Carbon::parse($request->birthdate)->format('Y-m-d'),
				
                'gender'        => $request->gender,
             
                
                
               
            ]);
            }
            if ($Newclient) {
				
               
                 $message = (app()->getLocale()=='en') ? "successfully Added" : "تم التسجيل بنجاح";
                Session::flash('message', $message);

               return redirect('/clientDashboard');
            } else {
				  $error_message = (app()->getLocale()=='en') ? "An error has occurred" : "حدث خطأ أثناء التسجيل. برجاء المحاولة مرة أخرى";
                Session::flash('error_message', $error_message);
                return redirect()->back();
			  //  return redirect(session('link')); 
            }
        
		  

    }
        
		public function add($id=null){
            if($id)
            {
				$nationalitys = Nationality::all();
                $object=Follower::find($id);
                return view('client.followerEdit')->with(['nationalitys'=>$nationalitys,'object'=>$object]);
            }
           // return view ('client.followerEdit');
        }
		public function update(request $request,$id)
    {
        $this->validate($request,[
            
                'name' => 'required|string|max:255',
                
                'relation'     => 'required|string|max:255',

        ]);
        $follower = Follower::find($id);
       $follower->name = $request->name;
            $follower->relation = $request->relation;
            $follower->gender = $request->gender;
            $follower->user_id = Auth::guard('client')->user()->id;
            $follower->nationality = $request->nationality;
            $follower->birthdate = Carbon::parse($request->birthdate)->format('Y-m-d');
          
        
        $follower->update();
		 $message = (app()->getLocale()=='en') ? "successfully updated" : "تم تعديل العضو بنجاح";
       Session::flash("message", $message );
        return redirect('/clientDashboard');

    }

 public function destroy($id)
    {
        Follower::find($id)->delete();
		 $message = (app()->getLocale()=='en') ? "successfully deleted" : "تم حذف  بنجاح";
         Session::flash("message", $message );

       

        return redirect()->back();
    }
}
