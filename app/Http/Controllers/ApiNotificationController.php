<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Calendar;
use App\Event;
use App\User;
use App\Dentist;
use App\Dentist_calander;
use App\Follower;
use App\Treatment;
use App\Service;
use App\Hospital;
use App\User_notification;
use Auth;
use DB;
use Lexx\ChatMessenger\Models\Message;
use Lexx\ChatMessenger\Models\Participant;
use Lexx\ChatMessenger\Models\Thread;
use Carbon\Carbon;
use App\Url;

class ApiNotificationController extends Controller
{
    
    public function NotificationByDentist(request $request)
    {
				
			$checkevent=DB::table('user_notifications')
			->select("user_notifications.*","user_notifications.id As notification_id","events.*")
			->join('events', 'user_notifications.event_id', '=', 'events.id')
			
              ->where('user_notifications.dentist_id', $request->dentist_id)
                         
		
			  ->get();
			  $searchString = ',';
		foreach ($checkevent as $i){
			if( strpos($i->dentist_id, $searchString) == false ) {

		if($i->dentist_id !=$request->dentist_id ){
	User_notification::where('event_id', $i->id)
		 ->where('dentist_id', $request->dentist_id)->delete();
}	}
		}

		
      //  $data = User_notification::where ('dentist_id',$request->dentist_id )->get();
		 $data=DB::table('user_notifications')
			->select("user_notifications.*","user_notifications.id As notification_id","services.*","events.*")
			->join('events', 'user_notifications.event_id', '=', 'events.id')
			->join('services', 'user_notifications.service_id', '=', 'services.id')
              ->where('user_notifications.dentist_id', $request->dentist_id)
              
               
		
			  ->get();
		if( sizeof($data) != 0 ) {
			
			
		
		
       return response()->json(['data'=>$data,'status'=>'success']);
       }else{
	   	return response()->json(['status'=>'Not found']);
	   }
    }
    
	public function NotificationByUser(request $request)
    {
				
			
		

		
      //  $data = User_notification::where ('user_id',$request->user_id )->get();
		 $data=DB::table('user_notifications')
			->select("user_notifications.*","user_notifications.id As notification_id","services.*","events.*")
			->join('events', 'user_notifications.event_id', '=', 'events.id')
			->join('services', 'user_notifications.service_id', '=', 'services.id')
              ->where('user_notifications.user_id', $request->user_id)
			  ->get();
		if( sizeof($data) != 0 ) {
			
			
		
		
       return response()->json(['data'=>$data,'status'=>'success']);
       }else{
	   	return response()->json(['status'=>'Not found']);
	   }
    }


}