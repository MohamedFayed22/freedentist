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

class NotificationController extends Controller
{
    
    public function getNotification(request $request)
    {
				
			if(isset($_POST['view'])){
		if(Auth::guard('dentist')->check()){
			$dentist_id=Auth::guard('dentist')->user()->id;
			if($_POST["view"] != '')
{
	DB::table('events')
			
              ->where('dentist_id', $dentist_id)
             
             ->update(['dentist_notify'=>1]);
}
			$date=date("Y-m-d");
			
			 $datax=DB::table('events')
			 
			->select("events.*","events.id As event_id","services.*")
		
			->join('services', 'events.treatment_id', '=', 'services.id')
             
			  	->where('events.dentist_notify',"=",0)
               ->where('events.dentist_id', $dentist_id)
			  
		   ->where(function($query) {
        $query->where('events.status', '=', 0);
        $query->orWhere('events.status', '=', 2);
        $query->orWhere('events.status', '=', 4);
    })
             
			  ->get();
			  
			//  var_dump($datax);
			 // 
			 $dentist_id=Auth::guard('dentist')->user()->id;
			 $count=DB::table('events')
			->select("events.*","events.id As event_id","services.*")
		
			->join('services', 'events.treatment_id', '=', 'services.id')
			
              ->where('events.dentist_notify',"=",0)
              
              ->where('events.dentist_id', $dentist_id)
              ->where(function($query) {
        $query->where('events.status', '=', 0);
        $query->orWhere('events.status', '=', 2);
        $query->orWhere('events.status', '=', 4);
    }) ->count();
			 $href="#";
			 $msg="";
			// $output=array();
		if( sizeof($datax) != 0 ) {
			foreach($datax as $data1){
				if($data1->status==0){
					$msg="لديك حجز موعد بانتظار اعتمادك رقم #".$data1->event_id;
				}elseif($data1->status==2){
					$msg="لقد تم تاكيد الحظور لموعد #".$data1->event_id;
				}elseif($data1->status==4){
					$msg="لقد تم رفض موعد #".$data1->event_id;
				}
			 $output[]= '
   <li>
   <a href="'.url('/Ddetails/'.$data1->event_id).'">
  
   <small><em>'.$msg.'</em></small>
   </a>
   </li>
   ';
		//	exit();
}
		
    
       }
     else{
	    $output[]= '
     <li><a href="#" class="text-bold text-italic">لا يوجد اشعارات</a></li>';
	   }
	   $data = array(
    'notification' => $output,
    'unseen_notification'  => $count
);
	 echo json_encode($data); 
		}
elseif(Auth::guard('client')->check()){
			$user_id=Auth::guard('client')->user()->id;
			if($_POST["view"] != '')
{
	DB::table('events')
			
              ->where('user_id', $user_id)
             
             ->update(['user_notify'=>1]);
}
			$date=date("Y-m-d");
			
			 $datax=DB::table('events')
			->select("events.*","events.id As event_id","services.*")
		
			->join('services', 'events.treatment_id', '=', 'services.id')
              ->where('events.user_id', $user_id)
              ->where('events.user_notify',"=",0)
              ->where(function($query) {
        $query->where('events.status', '=', 1);
        $query->orWhere('events.status', '=', 3);
        $query->orWhere('events.status', '=', 5);
    })
			  ->get();
			 // var_dump($datax);
			 // 
			 $user_id=Auth::guard('client')->user()->id;
			 $count=DB::table('events')
			->select("events.*","events.id As event_id","services.*")
		
			->join('services', 'events.treatment_id', '=', 'services.id')
              ->where('events.user_id', $user_id)
              ->where('events.user_notify',"=",0)
               ->where(function($query) {
        $query->where('events.status', '=', 1);
        $query->orWhere('events.status', '=', 3);
        $query->orWhere('events.status', '=', 5);
    })
			  ->count();
			 $href="#";
			 $msg="";
			// $output=array();
		if( sizeof($datax) != 0 ) {
			foreach($datax as $data1){
				if($data1->status==1){
					$msg="لقد تم اعتماد موعدك رقم #".$data1->event_id;
				}elseif($data1->status==3){
					$msg="لقد تم رفض موعد #".$data1->event_id;
				}elseif($data1->status==5){
					$msg="لقد تم تسجيل وصولك لموعد #".$data1->event_id;
				}
			 $output[]= '
   <li>
   <a href="'.url('/details/'.$data1->event_id).'">
  
   <small><em>'.$msg.'</em></small>
   </a>
   </li>
   ';
		//	exit();
}
		
    
       }
     else{
	    $output[]= '
     <li><a href="#" class="text-bold text-italic">لا يوجد اشعارات</a></li>';
	   }
	   $data = array(
    'notification' => $output,
    'unseen_notification'  => $count
);
	 echo json_encode($data); 
		}
		
     
	   
	  }
		
    }
    
	public function NotificationForUserTOArrive(request $request)
    {
				
			
		
$date = date('Y-m-d');
$day_next = date( 'Y-m-d', strtotime( $date . ' +1 day' ) );
		
      //  $data = User_notification::where ('user_id',$request->user_id )->get();
		 $data=DB::table('events')
			
              ->where('status', 1)
              ->where('event_date','=', $day_next)
			  ->get();
		//	  dd($data);
		if( sizeof($data) != 0 ) {
		    	 define('API_ACCESS_KEY','AAAAyrUJeek:APA91bHTUC8yJw56Lz0eKVgetNqv39SaypZJSgvZ-XNwbAIf-0BEkzJ9Hm8XC6zjvF_BB8lKVjPIv-H_jYbmNrKZQeyIQRWE9O07oGddAVNEkn3fGuAdL7pQge3e-QSqpHARf-5U1zkq');
                 $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
			foreach($data as $d){
				
			 $event=DB::table('events')
			->select("events.*","events.id As event_id","services.*")
			
			->join('services', 'events.treatment_id', '=', 'services.id')
              ->where('events.id', $d->id)
			  ->get();
			  
	 $device_id =$event[0]->device_id;  
//echo '<br/>';
	 $event_id =$d->id;  
	
 $token=$event[0]->device_id;

     $notification = [
            
            'body' => 'برجاء التأكيد على الموعد  موعدك #.'.$event_id.' بتاريخ '.$event[0]->event_date.' لخدمة '.$event[0]->service_name_ar.' الساعة '.$event[0]->start_time ,
            
        ];
        $extraNotificationData = ["message" => $notification,"event_id" =>$event_id];

        $fcmNotification = [
            //'registration_ids' => $tokenList, //multple token array
            'to'        => $token, //single token
            'notification' => $notification,
            'data' => $extraNotificationData
        ];
		 $headers = [
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        ];


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);
           
        echo $result;    
		
     //  return response()->json(['data'=>$data,'status'=>'success']);
       }}else{
	 //s  	return response()->json(['status'=>'Not found']);
	   }
    }

}