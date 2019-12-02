<?php
use App\Http\Controllers\Api;

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
use Auth;
use DB;

class EventController extends Controller
{
    
    public function Upcoming_Reserv(request $request)
    {
			echo	$request->user()->id ;
			die();
		

		
        $data = Event::where('event_date','>',Now())->where ('user_id',$user_id)->get();
		$this->data['events'] = $data;
		foreach($data as $d){
			if(!empty($d->dentist_id)){
				 $dentist = Dentist::where('id',$d->dentist_id)->first();
        $this->data['dentist'][] = $dentist;
			}else{
				
        $this->data['dentist'][] = '';
			}
        
		$treatments = Service::where('id',$d->treatment_id)->first();
        $this->data['treatments'][] = $treatments;
		if($d->follower_id!=""){
			 $users = Follower::where('id',$d->follower_id)->first();
        $this->data['user'][] = $users;
		}else{
		$users = User::where('id',$d->user_id)->first();
        $this->data['user'][] = $users;	
		}
			
		}
		 return response()->json(['data'=>$this->data,'success']);
        
    }
    public function prev_Reserv()
    {
        
        $data = Event::where('event_date','<',Now())->where ('user_id',Auth::guard('api')->user()->id)->get();
		$this->data['events'] = $data;
		foreach($data as $d){
         $dentist = Dentist::where('id',$d->dentist_id)->first();
        $this->data['dentist'][] = $dentist;
		$treatments = Service::where('id',$d->treatment_id)->first();
        $this->data['treatments'][] = $treatments;
		if($d->follower_id!=""){
			 $users = Follower::where('id',$d->follower_id)->first();
        $this->data['user'][] = $users;
		}else{
		$users = User::where('id',$d->user_id)->first();
        $this->data['user'][] = $users;	
		}
			
		}
		return response()->json(['data'=>$this->data,'success']);
       
    }
 //upcoming accepted reservation for dentist
 public function Upcoming_Reserv_acceptedD()
    {
        
		$c_dentist=Auth::guard('dentist')->user()->id;
		$date=date("Y-m-d");
        $data = Event::where('event_date','>',$date)
		->where ('status',1)
		->whereRaw("find_in_set($c_dentist,dentist_id)")
		
		->get();
		//dd($data);
		$this->data['events'] = $data;
		foreach($data as $d){
         
		$treatments = Service::where('id',$d->treatment_id)->first();
        $this->data['treatments'][] = $treatments;
		if($d->follower_id!=""){
			 $users = Follower::where('id',$d->follower_id)->first();
        $this->data['user'][] = $users;
		}else{
		$users = User::where('id',$d->user_id)->first();
        $this->data['user'][] = $users;	
		}
			
		}
		
       return response()->json(['data'=>$this->data,'success']);
       
    }

 public function Upcoming_Reserv_D()
    {
        
		$c_dentist=Auth::guard('dentist')->user()->id;
		$date=date("Y-m-d");
        $data = Event::where('event_date','>',$date)
		->where ('status',0)
		->whereRaw("find_in_set($c_dentist,dentist_id)")
		
		->get();
		//dd($data);
		$this->data['events'] = $data;
		foreach($data as $d){
         
		$treatments = Service::where('id',$d->treatment_id)->first();
        $this->data['treatments'][] = $treatments;
		if($d->follower_id!=""){
			 $users = Follower::where('id',$d->follower_id)->first();
        $this->data['user'][] = $users;
		}else{
		$users = User::where('id',$d->user_id)->first();
        $this->data['user'][] = $users;	
		}
			
		}
		
       return response()->json(['data'=>$this->data,'success']);
       
    }
public function prev_ReservD()
    {
        
		
        $data = Event::where('event_date','<',Now())->where('dentist_id',Auth::guard('dentist')->user()->id)->get();
		$this->data['events'] = $data;
		foreach($data as $d){
         
		$treatments = Service::where('id',$d->treatment_id)->first();
        $this->data['treatments'][] = $treatments;
		if($d->follower_id!=""){
			 $users = Follower::where('id',$d->follower_id)->first();
        $this->data['user'][] = $users;
		}else{
		$users = User::where('id',$d->user_id)->first();
        $this->data['user'][] = $users;	
		}
			
		}
		
        return response()->json(['data'=>$this->data,'success']);
       
    }
//pending upcoming reservation
public function pending_ReservD()
    {
        
		/*->orwhere('end_date','=',Now())*/
        $data = Event::where('event_date','>',Now())->where ('status',0)->where('dentist_id',Auth::guard('dentist')->user()->id)->get();
		$this->data['events'] = $data;
		foreach($data as $d){
         
		$treatments = Service::where('id',$d->treatment_id)->first();
        $this->data['treatments'][] = $treatments;
		if($d->follower_id!=""){
			 $users = Follower::where('id',$d->follower_id)->first();
        $this->data['user'][] = $users;
		}else{
		$users = User::where('id',$d->user_id)->first();
        $this->data['user'][] = $users;	
		}
			
		}
		
        return response()->json(['data'=>$this->data,'success']);
       
    }

public function reservationForm(){
        
		 $this->data['hospitals']=Hospital::all();
		 $this->data['followers']=Follower::all();
		 $this->data['treatments']=Treatment::all();
		 $this->data['dentists']=Dentist::all();
		 
		return view('event.reservationForm',$this->data);
    }
	public function reservationFormGet(){
        
		/*if($_GET['user']==0){
				$user_id = Auth::guard('client')->user()->id;
			}else{
				$user_id = Auth::guard('client')->user()->id;
				//$follower_id = $request->follower_id;
				
			}*/
			
            $date = $_GET['date'];
			$date = date('Y-m-d', strtotime($date));
            $this->data['date']=$date;
             $service_id = $_GET['service_id'];
            $hospital_id = $_GET['hospital_id'];
            $this->data['hospital_id']=$hospital_id;
            $this->data['service_id']=$service_id;
           // $user->created_by ='0';
		   $dates= DB::table('dentist_calanders')
            ->where('start_date','<',$date)
			 ->where('end_date','>',$date)
           
            ->where('hospital_id','=',$hospital_id)
            
            ->where('service_id','=',$service_id)
           
            ->get();
			//$this->data['times']=$dates;
			$nameOfDay = date('l', strtotime($date));
//echo $nameOfDay;
 $this->data['times']="";

 	

			foreach($dates as $date){
				/*$this->data['times']= DB::table('dentist_calanders')
				 ->select("dentist_calanders.*")
				 /*->select(DB::raw('*, max(id) as id'))*/
            /*->where('day','=',$nameOfDay)
           ->groupBy('start_time')
           
            ->get();*/
			$this->data['times'] = Dentist_calander::orderBy('id', 'desc')
			 ->select('dentist_calanders.*', DB::raw('group_concat(dentist_id) as dentist_id'))
                 
                ->where('day','=',$nameOfDay)
              
            ->where('hospital_id','=',$hospital_id)
            
            ->where('service_id','=',$service_id)
           
                ->groupBy('start_time')
                ->get();
			} if($this->data['times']==""){ 
			
				$this->data['error']="please check another date";
				 return redirect ('/reservation');
			}
			//$this->data['start']=$_GET['start'];
			//var_dump($xx);
			else{
				$this->data['error']="";
			}
		return response()->json(['data'=>$this->data,'success']);
       
    }
public function search($start,$end,$hospital,$service,$date,$dentist)
        
		{
			
		$user_name = Auth::guard('client')->user()->name;
			
			$service_name=DB::table('services')
			
              ->where('id', $service)
			  ->get();
			  $hospital_name=DB::table('hospitals')
              ->where('id', $hospital)
			  ->get();
			//$service_name=$service_name['service_name_ar'];
			//echo $segment = Request::segment(1);
//echo $request->route('start');
//return response()->json(['data'=>$this->data,'success']);
       
         return view('event.reservationFormFinish',['start' => $start,'end' => $end,'hospital' => $hospital,'service' => $service,'date' => $date,'dentist' => $dentist,'service_name' => $service_name,'hospital_name'=>$hospital_name,'user_name'=>$user_name]);
			 
        }


 public function store(request $request)
        {
          
            $event = new Event;
			/*if($request->user_id==0){
				$event->user_id = Auth::guard('client')->user()->id;
			}else{
				$event->user_id = Auth::guard('client')->user()->id;
				$event->follower_id = $request->follower_id;
				$event->relation = 1;
			}*/
			$event->user_id = Auth::guard('client')->user()->id;
            $event->start_time = $request->start;
            $event->end_time = $request->end;
            $event->event_date = $request->date;
             
            
            $event->treatment_id = $request->service;
            $event->hospital_id = $request->hospital;
            $event->dentist_id = $request->dentist;
           
            $event->diseases = $request->diseases;
           
            $event->drugs = $request->drugs;
            $event->description = $request->description;
            if($request->photo)
            {
                $name = time().'.'.$request->photo->getClientOriginalExtension();
                $request->photo->move(public_path('/images'),$name);
                $event->photo = $name;
            }
           
            
            
           // $user->created_by ='0';
            $event->save();
            $request->session()->flash("message", "تم اضافة العضو بنجاح" );

          return response()->json(['success']);
       
        }

/*public function store(request $request)
        {
          
            $event = new Event;
			if($request->user_id==0){
				$event->user_id = Auth::guard('client')->user()->id;
			}else{
				$event->user_id = Auth::guard('client')->user()->id;
				$event->follower_id = $request->follower_id;
				$event->relation = 1;
			}
			$date=explode('/', $request->date);
            $event->start_date = $date[0];
            $event->end_date = $date[1];
			$time=explode('/', $request->time);
            $event->start_time = $time[0];
            $event->end_time = $time[1];
            $event->day = $request->day;
        //    
            
            $event->treatment_id = $request->service_id;
            $event->hospital_id = $request->hospital_id;
            $event->is_diseases = $request->is_diseases;
            $event->diseases = $request->diseases;
            $event->is_drugs = $request->is_drugs;
            $event->drugs = $request->drugs;
            $event->description = $request->description;
            if($request->photo)
            {
                $name = time().'.'.$request->photo->getClientOriginalExtension();
                $request->photo->move(public_path('/images'),$name);
                $event->photo = $name;
            }
           
            
            
           // $user->created_by ='0';
            $event->save();
            $request->session()->flash("message", "تم اضافة العضو بنجاح" );

           return redirect('/UReservation');
        }*/
public function accepet(request $request ,$id)
        {
           
           
			if($id){
				$dentist_id = Auth::guard('dentist')->user()->id;
				DB::table('events')
			
              ->where('id', $id)
             ->update(['status'=>1,'dentist_id'=>$dentist_id]);
			
            $request->session()->flash("message", "تم اضافة العضو بنجاح" );

			}
			
        //    
            
            
           
            
            
           // $user->created_by ='0';
           return response()->json(['success']);
       
          
        }
public function neglect(request $request ,$id)
        {
           
           
			if($id){
				
			DB::table('events')
			
              ->where('id', $id)
             ->update(['status'=>2]);
			
            $request->session()->flash("message", "تم اضافة العضو بنجاح" );

			}
			
        //    
            
            
           
            
            
           // $user->created_by ='0';
           
           return response()->json(['success']);
       
        }
public function approveArrival(request $request ,$id)
        {
           
           //status 3 confrim arrival
			if($id){
				DB::table('events')
			
              ->where('id', $id)
             ->update(['status'=>3]);
			
            $request->session()->flash("message", "تم اضافة العضو بنجاح" );

			}
			
        //    
            
            
           
            
            
           // $user->created_by ='0';
           
            return response()->json(['success']);
       
        }
public function details($id)
        {
           
           //status 3 confrim arrival
			if($id){
			$this->data['object']=DB::table('events')
			->select("events.*","events.id As event_id","dentists.*","dentists.name As D_name","hospitals.*","services.*","users.name As Uname")
			->join('services', 'events.treatment_id', '=', 'services.id')
			->join('dentists', 'events.dentist_id', '=', 'dentists.id')
			->join('hospitals', 'events.hospital_id', '=', 'hospitals.id')
			->join('users', 'events.user_id', '=', 'users.id')
             ->where('events.id', $id)
             ->get();
			//dd($object);
			$follower="";
			if($this->data['object'][0]->follower_id!=""){
				$follower=DB::table('followers')
			
			
             ->where('followers.id', $this->data['object'][0]->follower_id)
             ->get();
			}
           $this->data['follower']=$follower;
             
			 return response()->json(['data'=>$this->data,'success']);
       
			}
			
                  
			
        }
}