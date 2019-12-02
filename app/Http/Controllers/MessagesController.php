<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\Dentist;
use Carbon\Carbon;
use Lexx\ChatMessenger\Models\Message;
use Lexx\ChatMessenger\Models\Participant;
use Lexx\ChatMessenger\Models\Thread;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Pusher; // Pusher\Laravel\Facades\Pusher


class MessagesController extends Controller
{

    public function __construct(Request $request, Redirector $redirect)
    {
        
        /*if(!Auth::guard('client')->check()&&!Auth::guard('dentist')->check()){
		 
         Redirect::to('/cLogin')->send();
        }*/
       
    }


    /**
     * Show all of the message threads to the user.
     *
     * @return mixed
     */
    public function index()
    {
 
       
       
        // All threads, ignore deleted/archived participants
        // $threads = Thread::getAllLatest()->get();

        // All threads that user is participating in
        
        $threads =array();
         $thread="";
            $mess="";
            $users="";
            
        if(isset(Auth::guard('dentist')->user()->id))
        {
            
            $threads = Thread::groupBy('user_id')->forUser(Auth::guard('dentist')->user()->id)->
              where('end_date','>',Now())->latest('updated_at')->get();
           
            
        }
        else if(isset(Auth::guard('client')->user()->id))
            {
        $threads = Thread::groupBy('user_id')->forUser(Auth::guard('client')->user()->id)->
        where('end_date','>',Now())->latest('updated_at')->get();
            }
          
             if(count($threads)>0){
           
          
            $id=$threads[0]->id;
            $thread = Thread::findOrFail($id);
          
           
        if(isset(Auth::guard('dentist')->user()->id))
        {
        $userId = Auth::guard('dentist')->user()->id;
        }else if(isset(Auth::guard('client')->user()->id))
        {
            $userId = Auth::guard('client')->user()->id;
        }
        $users = User::whereNotIn('id', $thread->participantsUserIds($userId))->get();

        $thread->markAsRead($userId);
        
       $mess= Message::where('thread_id',$id)->get();
       if(count($mess)>0)
       {
           foreach($mess as $m)
           {
               if($m->type==1)
               {
                   $m->user=dentist::find($m->user_id);
               }
               else if($m->type==2)
               {
                $m->user=user::find($m->user_id);
               }
           }
       }
       
           }
            return view('messenger.index', compact('threads','mess','thread', 'users'));
           
    }

    /**
     * Shows a message thread.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');

            return redirect()->route('messages');
        }

        // show current user in list if not a current participant
        // $users = User::whereNotIn('id', $thread->participantsUserIds())->get();

        // don't show the current user in list
        if(isset(Auth::guard('dentist')->user()->id))
        {
        $userId = Auth::guard('dentist')->user()->id;
        }else if(isset(Auth::guard('client')->user()->id))
        {
            $userId = Auth::guard('client')->user()->id;
        }
        $users = User::whereNotIn('id', $thread->participantsUserIds($userId))->get();

        $thread->markAsRead($userId);
        
       $mess= Message::where('thread_id',$id)->get();
       if(count($mess)>0)
       {
           foreach($mess as $m)
           {
               if($m->type==1)
               {
                   $m->user=dentist::find($m->user_id);
               }
               else if($m->type==2)
               {
                $m->user=user::find($m->user_id);
               }
           }
       }
     
        return view('messenger.show', compact('mess','thread', 'users'));
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
    public function update($id)
    {
       
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');

            return redirect()->route('messages');
        }

        // Restore all participants within a thread that has a new message.
        // we do not need it since when we remove a participant we do not wish the user to receive the message
        // $thread->activateAllParticipants();

        // Message
        
        if(isset(Auth::guard('client')->user()->id))
        {
            $user_id=Auth::guard('client')->user()->id;
            $type=2;
        }
        else  if(isset(Auth::guard('dentist')->user()->id))
        {
            $user_id=Auth::guard('dentist')->user()->id;
            $type=1;
        }
        $message = Message::create([
            'thread_id' => $thread->id,
            'user_id' => $user_id,
            'type'=>$type,
            'body' => Input::get('message'),
        ]);

        // Add replier as a participant
        $participant = Participant::firstOrCreate([
            'thread_id' => $thread->id,
            'user_id' =>  $user_id,
            'type'=>$type
        ]);
        $participant->last_read = new Carbon;
        $participant->save();

        // Recipients
        if (Input::has('recipients')) {
            // add code logic here to check if a thread has max participants set
            // utilize either $thread->getMaxParticipants()  or $thread->hasMaxParticipants()

            $thread->addParticipant(Input::get('recipients'));
        }
        if(isset(Auth::guard('dentist')->user()->id))
        {
            $message->user=dentist::find(Auth::guard('dentist')->user()->id);
        }
        else  if(isset(Auth::guard('client')->user()->id))
        
        {
            $message->user=user::find(Auth::guard('client')->user()->id);
        }
      
        $html = view('messenger.partials.html-message', compact('message'))->render();

        // check if pusher is allowed
        if (config('chatmessenger.use_pusher')) {
            $this->oooPushIt($message);
        }

        if (request()->ajax()) {
            return response()->json([
                'status' => 'OK',
                'message' => $message,
                'html' => $html,
                'thread_subject' => $message->thread->subject,
            ]);
        }

        return redirect()->route('messages.show', $id);
    }

    /**
     * Send the new message to Pusher in order to notify users.
     *
     * @param Message $message
     */
    protected function oooPushIt(Message $message, $html = '')
    {
        $thread = $message->thread;
        $sender = $message->user;

        $data = [
            'thread_id' => $thread->id,
            'div_id' => 'thread_' . $thread->id,
            'sender_name' => $sender->name,
            'thread_url' => route('messages.show', ['id' => $thread->id]),
            'thread_subject' => $thread->subject,
            'message' => $message->body,
            'html' => $html,
            'text' => str_limit($message->body, 50),
        ];

        $recipients = $thread->participantsUserIds();
        if (count($recipients) > 0) {
            foreach ($recipients as $recipient) {
                if ($recipient == $sender->id) {
                    continue;
                }

                $pusher_resp = Pusher::trigger(['for_user_' . $recipient], 'new_message', $data);
                // We're done here - how easy was that, it just works!
            }
        }

        return $pusher_resp;
    }

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