<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\Dentist;
use App\Event;
use Carbon\Carbon;
use Lexx\ChatMessenger\Models\Message;
use Lexx\ChatMessenger\Models\Participant;
use Lexx\ChatMessenger\Models\Thread;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use DB;


class ApiMessagesController extends Controller
{
    public function getThreadId(Request $request)
    {
        $query='SELECT x.* FROM lexx_participants x left join lexx_participants y on x.thread_id=y.thread_id where x.user_id='.$request->input('c').' and x.type=2 and y.user_id='.$request->input('d').' and y.type=1';
        $res=DB::select($query);
       $data['threadId']=$res[0]->thread_id;
        return response()->json(['data'=>$data,'success'=>'true','messages'=>'']);
       
    }

    public function indexC(Request $request)
    {
 
       
        $threads =array();
         $thread="";
            $data=array();
          
            
        
            
            $threads = Thread::groupBy('user_id')->forUser($request->user()->id)->
            where('end_date','>',Now())->where('type',2)->latest('updated_at')->get();
           
        if(count($threads)>0)
        {
            foreach($threads as $k=> $thread){
               
               
               
                $par=Participant::where('thread_id',$thread->id)->where('type',1)->first();
                
                $clients=Participant::where('thread_id',$thread->id)->where('type',2)->first();
                $client=Dentist::find($par->user_id);
                $mess=Message::where('thread_id',$thread->id)->orderby('id','desc')->first();
                 $data['clients'][$k] = DB::table('dentists')->select('profile_photo','hospital_name_ar','hospital_name_en')
                 ->leftjoin('hospitals','dentists.hospital','hospitals.id')->where('dentists.id', $par->user_id)->first();
                $data['clients'][$k]->threadId=$thread->id;
                $data['clients'][$k]->name=$client->name;
                $data['clients'][$k]->created_at= Carbon::parse($mess->created_at)->format('Y-m-d H:i:s'); 
                $data['clients'][$k]->lstMessage=$mess->body;
               
               
               
               
                  
            }
            
             return response()->json(['data'=>$data,'success'=>'true','messages'=>'']);
       
        }
            return response()->json(['data'=>$data,'success'=>'fasle','message'=>'Not Messages']);
       
           // return view('messenger.index', compact('threads','mess','thread', 'users'));
           
    }
    
     public function indexD(Request $request)
    {
 
       
        $threads =array();
         $thread="";
            $data=array();
          
            
            $threads = Thread::groupBy('user_id')->forUser($request->user()->id)->
            where('end_date','>',Now())->where('type',1)->latest('updated_at')->get();
           
        if(count($threads)>0)
        {
            foreach($threads as $k=> $thread){
                $par=Participant::where('thread_id',$thread->id)->where('type',1)->first();
                
                $clients=Participant::where('thread_id',$thread->id)->where('type',2)->first();
                $client=User::find($clients->user_id);
                $mess=Message::where('thread_id',$thread->id)->orderby('id','desc')->first();
                $data['clients'][$k] = DB::table('dentists')->select('hospital_name_ar','hospital_name_en')
                 ->leftjoin('hospitals','dentists.hospital','hospitals.id')->groupBy('dentists.id')->where('dentists.id', $par->user_id)->first();
                $data['clients'][$k]->threadId=$thread->id;
                $data['clients'][$k]->name=$client->name;
                $data['clients'][$k]->created_at= Carbon::parse($mess->created_at)->format('Y-m-d H:i:s'); 
                $data['clients'][$k]->lstMessage=$mess->body;
                  
            }
            
             return response()->json(['data'=>$data,'success'=>'true','messages'=>'']);
       
        }
            return response()->json(['data'=>$data,'success'=>'fasle','message'=>'Not Messages']);
       
           // return view('messenger.index', compact('threads','mess','thread', 'users'));
           
    }

    /**
     * Shows a message thread.
     *
     * @param $id
     * @return mixed
     */
    public function show($id,Request $request)
    {
        
            $thread = Thread::find($id);
            if($thread)
            {
     


        $thread->markAsRead($request->user()->id);
        $request->input('indexpage')?$indexpage= $request->input('indexpage'):$indexpage=10;
       $data= Message::select('body','created_at','type','user_id')->where('thread_id',$id)->orderby('id','desc')->paginate($indexpage);
      
       if(count($data)>0)
       {
           foreach($data as $m)
           {
               
               if($m->type==1)
               {
                   $m->name=dentist::find($m->user_id)->name;
               }
               else if($m->type==2)
               {
                  
                $m->name=user::find($m->user_id)->name;
               }
           }
       }
       
        return response()->json(['data'=>$data,'success'=>'true','messages'=>'']);
            }
            else{
                return response()->json(['data'=>$data,'success'=>'fasle','message'=>'Not Found Thread']);
            }
     
        
    }

    /**
     * Creates a new message thread.
     *
     * @return mixed
     */
    public function create()
    {
        $users = User::where('id', '!=', Auth::guard('client')->user()->id)->get();

        return view('messenger.create', compact('users'));
    }

    /**
     * Stores a new message thread.
     *
     * @return mixed
     */
    public function store()
    {
        $input = Input::all();

        $thread = Thread::create([
            'subject' => $input['subject'],
        ]);

        // Message
        $message = Message::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::guard('client')->user()->id,
            'body' => $input['message'],
        ]);

        // Sender
        Participant::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::guard('client')->user()->id,
            'last_read' => new Carbon,
        ]);

        // Recipients
        if (Input::has('recipients')) {
            // add code logic here to check if a thread has max participants set
            // utilize either $thread->getMaxParticipants()  or $thread->hasMaxParticipants()

            $thread->addParticipant($input['recipients']);
        }

        // check if pusher is allowed
        if (config('chatmessenger.use_pusher')) {
            $this->oooPushIt($message);
        }

        if (request()->ajax()) {
            return response()->json([
                'status' => 'OK',
                'message' => $message,
                'thread' => $thread,
            ]);
        }

        return redirect()->route('messages');
    }

    /**
     * Adds a new message to a current thread.
     *
     * @param $id
     * @return mixed
     */
    public function update($id,Request $request)
    {
        $thread = Thread::find($id);
            if($thread)
            {
              $user_id=$request->user()->id;
              if(isset($request->user()->hospital))
              {
                   $type=1;
		 
		 
              }
              else{
                  $type=2; 
				  
              }
            
            
            
       
      
        $message = Message::create([
            'thread_id' => $thread->id,
            'user_id' => $user_id,
            'type'=>$type,
            'device_id'=>$request->device_id,
            'body' => Input::get('message_body'),
        ]);
define('API_ACCESS_KEY','AAAAyrUJeek:APA91bHTUC8yJw56Lz0eKVgetNqv39SaypZJSgvZ-XNwbAIf-0BEkzJ9Hm8XC6zjvF_BB8lKVjPIv-H_jYbmNrKZQeyIQRWE9O07oGddAVNEkn3fGuAdL7pQge3e-QSqpHARf-5U1zkq');
 $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
 $token=$request->device_id;
 //echo $thread->id;
 if(isset($request->user()->hospital))
              {
            $data_user = Message::where('thread_id',$thread->id)->where('type',2)->get()->first();     
		  $data = Event::where('user_id',$data_user->user_id)->get()->first();
	//	  dd($data);
				   $token=$data->device_id;
              }
              else{
              $data_user = Message::where('thread_id',$thread->id)->where('type',1)->get()->first();  
				   $datax = Dentist::where('id',$data_user->user_id)->get()->first(); 
			//	   dd($data);
				  $token=$datax->device_id;
              }
    $notification = [
            
            'body' => 'لديك رسالة على الخاص '
            
        ];
        $extraNotificationData = ["message" => $notification];

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

 
            // echo $result; 
        // Add replier as a participant
        $participant = Participant::firstOrCreate([
            'thread_id' => $thread->id,
            'user_id' =>  $user_id,
            'type'=>$type
        ]);
        $participant->last_read = new Carbon;
        $participant->save();

       
       
            $user=$request->user();
            $message->name=$user->name;
       $data=$message;
         unset($data['thread']);
            return response()->json(['data'=>$data,'success'=>'true','messages'=>'']);
            }
            else{
                return response()->json(['data'=>$data,'success'=>'fasle','message'=>'Not Found Thread']);
            }
     

     
    }

    /**
     * Send the new message to Pusher in order to notify users.
     *
     * @param Message $message
     */
   
    /**
     * Mark a specific thread as read, for ajax use.
     *
     * @param $id
     */
    public function read($id)
    {
        $thread = Thread::find($id);
        if (!$thread) {
            abort(404);
        }
        if(isset(Auth::guard('client')->user()->id))
        
        {
            $ids =Auth::guard('client')->user()->id;
        }
        else  if(isset(Auth::guard('dentist')->user()->id))
        
        {
        $ids = Auth::guard('dentist')->user()->id;

        }
        $thread->markAsRead($ids);
    }

    /**
     * Get the number of unread threads, for ajax use.
     *
     * @return array
     */
    public function unread()
    {
          if(isset(Auth::guard('client')->user()->id))
        
        {
            $count = Auth::guard('client')->user()->unreadMessagesCount();
        }
        else  if(isset(Auth::guard('dentist')->user()->id))
        
        {
        $count = Auth::guard('dentist')->user()->unreadMessagesCount();

        }

        return ['msg_count' => $count];
    }
}