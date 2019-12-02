<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Dentist_calander;
use App\Service;
use App\Hospital;
use Auth;
use Session;
use Route;
use Carbon\Carbon;
use DB;
use DateTime;
use DatePeriod;
use DateInterval;

class ApiDentist_calanderController extends Controller
{
	
	
   public function showCalanderForm(request $request)
    {
		
		$dentist_id = $request->dentist_id;
		$datas= DB::table('dentist_calanders')
            ->where('dentist_id','=',$dentist_id)
			  ->groupBy('day')
            ->get();
			//dd($datas);
			$day_data="";
			if(!empty($datas)){
				foreach($datas as $date){
					
				$day_data = DB::table('dentist_calanders')
            ->where('dentist_id','=',$dentist_id)
            ->where('day','=',"$date->day")
			  
            ->get();	
			//var_dump($day_data);
				}
				$day_data;
			}else{
				return response()->json(['status'=>'Not Found']);
			}
		$services = Service::all();
		$hospitals = Hospital::all();
			//echo	$dentist_id = Auth::guard('dentist')->user()->name;
    
	   return response()->json(['services'=>$services,'hospitals'=>$hospitals ,"service_datas"=>$datas,'day_data'=>$day_data,'status'=>'success']);
    }//
 public function showCalanderForm2(request $request)
    {
		
		$dentist_id = $request->dentist_id;
	
					
				$day_data   = DB::table('dentist_calanders')
				->select("dentist_calanders.*","dentist_calanders.id As calander_id","dentists.*","dentists.name As D_name","dentists.id As D_id","hospitals.*","hospitals.id As H_id","services.id As S_id","services.*")
			->join('services', 'dentist_calanders.service_id', '=', 'services.id')
			->join('dentists', 'dentist_calanders.dentist_id', '=', 'dentists.id')
			->join('hospitals', 'dentist_calanders.hospital_id', '=', 'hospitals.id')
            ->where('dentist_id','=',$dentist_id)
           
			  
            ->get();	
            
		//	var_dump($day_data);
				
			//	$day_data;
		
	
			//echo	$dentist_id = Auth::guard('dentist')->user()->name;
    
	   return response()->json(['day_data'=>$day_data,'status'=>'success']);
    }//
	public function calanderAction(Request $request){
		
        $this->validate($request,
            [
                'hospital_id' => 'required|numeric',
                
                'service_id'     => 'required|numeric',
                
				
				
            ]);

        
            
           
			if($request->end_date==$request->start_date){
				 $client = new Dentist_calander;
				 $client->dentist_id = $request->dentist_id;
            $client->service_id = $request->service_id;
            $client->hospital_id = $request->hospital_id;
            $client->start_date = Carbon::parse($request->start_date)->format('Y-m-d');
			 $client->day =		date('l', strtotime($request->start_date));
 $client->end_date =	date('Y-m-d', strtotime("+1 day", strtotime($request->start_date)));
  $client->start_time = $request->start_time;
            $client->end_time = $request->end_time;
			$client->save();
			}else{
			//   $start_date = date('Y-m-d',strtotime("-1 day", strtotime($request->start_date))); 
			   $start_date = date('Y-m-d', strtotime($request->start_date)); 

			//	$start_date =  strtotime($request->start_date);
				$end_date =  strtotime($request->end_date);
				$begin = new DateTime( $start_date);
                $end   = new DateTime( $request->end_date );
				//for ($i=$start_date; $i<=$end_date; $i++)  {
					// ini_set('max_execution_time', 0); 

					for($i = $begin; $i <= $end; $i->modify('+1 day')){
			// $date= date('Y-m-d', strtotime("+1 day", strtotime($i->format("Y-m-d"))));
			 $date= date('Y-m-d',  strtotime($i->format("Y-m-d")));
			$date2= date('Y-m-d', strtotime("+1 day", strtotime($date)));
           $dayName=date('l', strtotime($date));
	 //  echo "<br/>";
        if($request->day == $dayName) {
		//	 echo $dayName;
			  $client = new Dentist_calander;
			$client->dentist_id = $request->dentist_id;
            $client->service_id = $request->service_id;
            $client->hospital_id = $request->hospital_id;
            $client->start_date = $date;
           $client->end_date =	$date2; 
		  $client->day =$dayName;
		  $client->start_time = $request->start_time;
            $client->end_time = $request->end_time;
		  $client->save();
        }

    }
			 
			}
            
           
           /* $client->day = $request->day;*/
            
               
			
            
            if ($client) {
			//	echo 'd';
               
                return response()->json(['data'=>$client,'status'=>'success']);
       
            } 
		  

    }
	
	public function calanderAction2(Request $request){
		
		
        $validation=$this->validate($request,
            [
                'hospital_id' => 'required|numeric',
                
                'service_id'     => 'required|numeric',
                
				
				
            ]);
/*if($validation){
	
 return response()->json(['status'=>'error']);
} */      
         $client = Dentist_calander::find($request->calander_id);
           
            $client->dentist_id = $request->dentist_id;
            $client->service_id = $request->service_id;
            $client->hospital_id = $request->hospital_id;
            $client->start_date = Carbon::parse($request->start_date)->format('Y-m-d');
			if($request->end_date==$request->start_date){
			 $client->day =		date('l', strtotime($request->start_date));
 $client->end_date =	date('Y-m-d', strtotime("+1 day", strtotime($request->start_date)));
			}else{
			 $client->end_date =Carbon::parse($request->end_date)->format('Y-m-d');	
            $client->day = $request->day;
			}
        //    $client->end_date = $request->end_date;
            $client->start_time = $request->start_time;
            $client->end_time = $request->end_time;
        //   $client->day = $request->day;
            
               
			 $client->update();
           
            if ($client) {
			//	echo 'd';
               
                return response()->json(['data'=>$client,'status'=>'success']);
       
            } 
		  

    }
	
	 
	 public function destroy(Request $request)
    {
		//echo 'jjj';
		if($request->id){
			
		if(Dentist_calander::find($request->id)){
			
		
        Dentist_calander::find($request->id)->delete();
        
        return response()->json(['status'=>'sucess']);
       }else{
	   	 return response()->json(['status'=>'Not found']);
	   }}else{
	   	 return response()->json(['status'=>'Not found']);
	   }
    }
 public function selectDay(Request $request)

    {

       
			//echo $request->hospital_id;
			//exit();
			$check_users=DB::table('events')
			
             
              ->where('hospital_id', $request->hospital_id)
              ->where('treatment_id', $request->service_id)
              
			  ->get();
			  if(count($check_users)){
			//  	foreach($check_users as $check_user){
					 $days = DB::table('dentist_calanders')
   	->select("dentist_calanders.*")
	  ->where('dentist_calanders.service_id', $request->service_id)
    ->where('dentist_calanders.hospital_id', $request->hospital_id)
    ->where('dentist_calanders.end_date','>',now())
	  ->where('dentist_calanders.status','=',0)
   
 

	->orderBy('end_date', 'DESC')
	->groupBy('start_date')
    ->get();
	
	//var_dump($days);
	/*
	->whereExists(function($query) use ($request)
                {
                    $query->select('dentist_id')
                          ->from('events')
              ->whereRaw('events.dentist_id = dentist_calanders.dentist_id')
			  ->where('hospital_id', $request->hospital_id)
    ->where('treatment_id', $request->service_id)
   
        ->where('status','=',0);
                })
	->whereNotIn('dentist_calanders.start_date', function($q) use ($request){
    $q->select('event_date')->from('events')
	->where('hospital_id', $request->hospital_id)
    ->where('treatment_id', $request->service_id)
   
        ->where('status','!=',0)
     
;})*/
	//exit();
	
	 foreach($days as $key => $value){
	 	
	 	 $startTime = strtotime($value->start_date);
$endTime = date(strtotime($value->end_date));
//$thisDatex = "";
for ( $i = $startTime; $i <= $endTime; $i = $i + 86400 ) {
	 $thisDate=date('l', $i);
  // $thisDate = date( 'Y-m-d', $i ); // 2010-05-01, 2010-05-02, etc
  if($thisDate==$value->day){
  	//echo $thisDate = date( 'Y-m-d', $i );
  	$thisDatex[]= date( 'Y-n-j', $i );
	$day[]=$value->day;
  }
	// }
 //  $thisDatex;
        }   
	}			
           
	}else{
		 $days = DB::table('dentist_calanders')
   
    ->where('dentist_calanders.service_id', $request->service_id)
    ->where('dentist_calanders.hospital_id', $request->hospital_id)
    ->where('dentist_calanders.end_date','>',now())
   
	->orderBy('end_date', 'DESC')
	->groupBy('start_date')
    ->get();
	
	 $allData = array();
	 foreach($days as $key => $value){
	 	
	 	 $startTime = strtotime($value->start_date);
$endTime = date(strtotime($value->end_date));
//$thisDatex = "";
for ( $i = $startTime; $i <= $endTime; $i = $i + 86400 ) {
	 $thisDate=date('l', $i);
  // $thisDate = date( 'Y-m-d', $i ); // 2010-05-01, 2010-05-02, etc
  if($thisDate==$value->day){
  	//echo $thisDate = date( 'Y-m-d', $i );
  	$thisDatex[]= date( 'Y-n-j', $i );
	$day[]=$value->day;
  }
	 }
 //  $thisDatex;
        }  
		} 
		//echo json_encode($thisDatex);
            return response()->json(['data'=>$thisDatex,'day'=>$day]);

        

    }
 
public function selectDay2(Request $request)

    {

       
			//echo $request->hospital_id;
			//exit();
			$check_users=DB::table('events')
			
             
              ->where('hospital_id', $request->hospital_id)
              ->where('treatment_id', $request->service_id)
               
			  ->get();
			  if(count($check_users)){
			  	foreach($check_users as $check_user){
					echo $check_user->dentist_id;
					 $days[] = DB::table('dentist_calanders')
   	->select("dentist_calanders.*","events.*")
	->Join('events', 'dentist_calanders.start_date', '=', 'events.event_date')
    ->where('dentist_calanders.service_id', $request->service_id)
    ->where('dentist_calanders.hospital_id', $request->hospital_id)
    ->where('dentist_calanders.dentist_id','!=',$check_user->dentist_id)
    
 
	->orderBy('end_date', 'DESC')
	->groupBy('start_date')
    ->get();
	}
	var_dump($days);
	//exit();
	//echo $days;
	 foreach($days as $key => $value){
	 	
	 	 $startTime = strtotime($value[$key]->start_date);
$endTime = date(strtotime($value[$key]->end_date));
//$thisDatex = "";
for ( $i = $startTime; $i <= $endTime; $i = $i + 86400 ) {
	 $thisDate=date('l', $i);
  // $thisDate = date( 'Y-m-d', $i ); // 2010-05-01, 2010-05-02, etc
  if($thisDate==$value[$key]->day){
  	//echo $thisDate = date( 'Y-m-d', $i );
  	$thisDatex[]= date( 'Y-n-j', $i );
	$day[]=$value[$key]->day;
  }
	// }
 //  $thisDatex;
        }   
	}			
           
	}else{
		 $days = DB::table('dentist_calanders')
   
    ->where('dentist_calanders.service_id', $request->service_id)
    ->where('dentist_calanders.hospital_id', $request->hospital_id)
    ->where('dentist_calanders.end_date','>',now())
   
	->orderBy('end_date', 'DESC')
	->groupBy('start_date')
    ->get();
	
	 $allData = array();
	 foreach($days as $key => $value){
	 	
	 	 $startTime = strtotime($value->start_date);
$endTime = date(strtotime($value->end_date));
//$thisDatex = "";
for ( $i = $startTime; $i <= $endTime; $i = $i + 86400 ) {
	 $thisDate=date('l', $i);
  // $thisDate = date( 'Y-m-d', $i ); // 2010-05-01, 2010-05-02, etc
  if($thisDate==$value->day){
  	//echo $thisDate = date( 'Y-m-d', $i );
  	$thisDatex[]= date( 'Y-n-j', $i );
	$day[]=$value->day;
  }
	 }
 //  $thisDatex;
        }  
		} 
		//echo json_encode($thisDatex);
            return response()->json(['data'=>$thisDatex,'day'=>$day]);

        

    }	
public function getServices(Request $request)

    {

       $dentist_id = $request->dentist_id;
	
			
			//echo $request->hospital_id;
			//exit();
            $services = DB::table('dentist_calanders')
			->select("services.*","services.id As service_id","dentist_calanders.*")
			->join('services', 'dentist_calanders.service_id', '=', 'services.id')
    
    ->where('dentist_id', $dentist_id)
    
    ->get();
	 
            return response()->json(['services'=>$services]);

        

    }


}
