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
    use Auth;
    use DB;
    use Illuminate\Support\Facades\Mail;
    use App\Mail\SendMail;
    use App\Mail\SendMailCancel;
    use Lexx\ChatMessenger\Models\Message;
    use Lexx\ChatMessenger\Models\Participant;
    use Lexx\ChatMessenger\Models\Thread;
    use Carbon\Carbon;
    use App\Url;
    use Session;

    class EventController extends Controller
    {
        public function index ()
        {
            $events = [];
            $data = Event::all();
            if ($data->count()) {
                foreach ($data as $key => $value) {
                    $events[] = Calendar::event(
                        $value->title,
                        true,
                        new \DateTime($value->start_date),
                        new \DateTime($value->end_date . ' +1 day'),
                        null,
                        // Add color and link on event
                        [
                            'color' => '#f05050',
                            'url' => 'pass here url and any route',
                        ]
                    );
                }
            }
            $calendar = Calendar::addEvents($events)
                ->setOptions([
                    'firstDay' => 1,
                    'editable' => true,
                    'selectable' => true,

                    'minTime' => '05:00:00',
                    'maxTime' => '22:00:00',
                ])
                ->setCallbacks([
                    'eventClick' => 'function(event) { alert(event.title)}',
                    'select' => 'function(start, end, allDay) { alert("d")}',
                ]);

            return view('fullcalender', compact('calendar'));
        }

        public function Upcoming_Reserv ()
        {
            if (!Auth::guard('client')->check()) {
                return redirect('cLogin');
            }
            $date = date("Y-m-d");
            $data = Event::where('user_id', Auth::guard('client')->user()->id)
                ->where(function ($query) use ($date) {
                    $query->where('event_date', '>', $date)
                        ->orwhere('event_date', '=', $date);

                })
                ->where('status', 0)
                ->paginate(15);
            $this->data['events'] = $data;

            foreach ($data as $d) {
                if (!empty($d->dentist_id)) {
                    $dentist = Dentist::where('id', $d->dentist_id)->first();
                    $this->data['dentist'][] = $dentist;
                } else {

                    $this->data['dentist'][] = '';
                }

                $treatments = Service::where('id', $d->treatment_id)->first();
                $this->data['treatments'][] = $treatments;
                if ($d->follower_id != "") {
                    $users = Follower::where('id', $d->follower_id)->first();
                    $this->data['user'][] = $users;
                } else {
                    $users = User::where('id', $d->user_id)->first();
                    $this->data['user'][] = $users;
                }

            }

            return view('frontend.client.nextCalenderP', $this->data);
        }

        public function prev_Reserv ()
        {
            if (!Auth::guard('client')->check()) {
                return redirect('cLogin');
            }
            $date = date("Y-m-d");
            $data = Event::where('user_id', Auth::guard('client')->user()->id)
                ->where(function ($query) use ($date) {
                    $query->where('event_date', '<', $date);
                    $query->orwhere('status', 5);

                })->paginate(15);
            $this->data['events'] = $data;
            foreach ($data as $d) {
                $dentist = Dentist::where('id', $d->dentist_id)->first();
                $this->data['dentist'][] = $dentist;
                $treatments = Service::where('id', $d->treatment_id)->first();
                $this->data['treatments'][] = $treatments;
                if ($d->follower_id != "") {
                    $users = Follower::where('id', $d->follower_id)->first();
                    $this->data['user'][] = $users;
                } else {
                    $users = User::where('id', $d->user_id)->first();
                    $this->data['user'][] = $users;
                }

            }

            return view('frontend.client.prevCalender', $this->data);
        }

        public function Upcoming_AReserv ()
        {
            if (!Auth::guard('client')->check()) {
                return redirect('cLogin');
            }
            $date = date("Y-m-d");
            $data = Event::where('user_id', Auth::guard('client')->user()->id)
                ->where(function ($query) use ($date) {
                    $query->where('event_date', '>', $date)
                        ->orwhere('event_date', '=', $date);

                })
                ->where(function ($query) {
                    $query->where('status', 1)
                        ->orwhere('status', 2);
                })
                ->paginate(15);
            $this->data['events'] = $data;
            foreach ($data as $d) {
                if (!empty($d->dentist_id)) {
                    $dentist = Dentist::where('id', $d->dentist_id)->first();
                    $this->data['dentist'][] = $dentist;
                } else {

                    $this->data['dentist'][] = '';
                }

                $treatments = Service::where('id', $d->treatment_id)->first();
                $this->data['treatments'][] = $treatments;
                if ($d->follower_id != "") {
                    $users = Follower::where('id', $d->follower_id)->first();
                    $this->data['user'][] = $users;
                } else {
                    $users = User::where('id', $d->user_id)->first();
                    $this->data['user'][] = $users;
                }

            }

            return view('frontend.client.nextCalender', $this->data);
        }

        //upcoming accepted reservation for dentist
        public function Upcoming_Reserv_acceptedD ()
        {
            if (!Auth::guard('dentist')->check()) {
                return redirect('dLogin');
            }
            $c_dentist = Auth::guard('dentist')->user()->id;
            $date = date("Y-m-d");
            $data = Event::whereRaw("find_in_set($c_dentist,dentist_id)")->where(function ($query) use ($date) {
                $query->where('event_date', '>', $date)
                    ->orwhere('event_date', '=', $date);

            })->where(function ($query) {
                $query->where('status', 1)
                    ->orwhere('status', 2);
            })->paginate(15);
            //dd($data);
            $this->data['events'] = $data;
            foreach ($data as $d) {

                $treatments = Service::where('id', $d->treatment_id)->first();
                $this->data['treatments'][] = $treatments;
                if ($d->follower_id != "") {
                    //	echo $d->follower_id;
                    $users = Follower::where('id', $d->follower_id)->first();
                    $this->data['user'][] = $users;
                    //	dd($users);
                } else {
                    $users = User::where('id', $d->user_id)->first();
                    $this->data['user'][] = $users;
                }

            }

            return view('vendor.nextCalender', $this->data);
        }

        public function Upcoming_Reserv_D ()
        {
            if (!Auth::guard('dentist')->check()) {
                return redirect('dLogin');
            }
            $c_dentist = Auth::guard('dentist')->user()->id;
            $date = date("Y-m-d");
            $data = Event::where('status', 0)
                ->where(function ($query) use ($date) {
                    $query->where('event_date', '>', $date)
                        ->orwhere('event_date', '=', $date);

                })
                ->whereRaw("find_in_set($c_dentist,dentist_id)")
                ->paginate(15);
            //dd($data);
            $this->data['events'] = $data;
            foreach ($data as $d) {

                $treatments = Service::where('id', $d->treatment_id)->first();
                $this->data['treatments'][] = $treatments;
                if ($d->follower_id != "") {
                    $users = Follower::where('id', $d->follower_id)->first();
                    $this->data['user'][] = $users;
                } else {
                    $users = User::where('id', $d->user_id)->first();
                    $this->data['user'][] = $users;
                }

            }

            return view('vendor.nextCalenderP', $this->data);
        }

        public function prev_ReservD ()
        {
            if (!Auth::guard('dentist')->check()) {
                return redirect('dLogin');
            }
            $date = date("Y-m-d");
            $data = Event::where('dentist_id', Auth::guard('dentist')->user()->id)->where(function ($query) use ($date) {
                $query->where('event_date', '<', $date);
                $query->orwhere('status', 5);

            })->paginate(15);
            $this->data['events'] = $data;
            foreach ($data as $d) {

                $treatments = Service::where('id', $d->treatment_id)->first();
                $this->data['treatments'][] = $treatments;
                if ($d->follower_id != "") {
                    $users = Follower::where('id', $d->follower_id)->first();
                    $this->data['user'][] = $users;
                } else {
                    $users = User::where('id', $d->user_id)->first();
                    $this->data['user'][] = $users;
                }

            }

            return view('vendor.prevCalender', $this->data);
        }

//pending upcoming reservation
        public function pending_ReservD ()
        {
            if (!Auth::guard('dentist')->check()) {
                return redirect('dLogin');
            }
            /*->orwhere('end_date','=',Now())*/
            $data = Event::where('event_date', '>', Now())->where('status', 0)->where('dentist_id', Auth::guard('dentist')->user()->id)->get();
            $this->data['events'] = $data;
            foreach ($data as $d) {

                $treatments = Service::where('id', $d->treatment_id)->first();
                $this->data['treatments'][] = $treatments;
                if ($d->follower_id != "") {
                    $users = Follower::where('id', $d->follower_id)->first();
                    $this->data['user'][] = $users;
                } else {
                    $users = User::where('id', $d->user_id)->first();
                    $this->data['user'][] = $users;
                }

            }

            return view('vendor.pendCalender', $this->data);
        }

        public function reservationForm ()
        {

            $this->data['hospitals'] = Hospital::all();
            $this->data['followers'] = Follower::all();
            $this->data['treatments'] = Service::all();
            $this->data['dentists'] = Dentist::all();

            return view('event.reservationForm', $this->data);
        }

        public function reservationFormGet2 (request $request)
        {

            /*if($_GET['user']==0){
                    $user_id = Auth::guard('client')->user()->id;
                }else{
                    $user_id = Auth::guard('client')->user()->id;
                    //$follower_id = $request->follower_id;

                }*/
            $this->validate($request,
                [
                    'service_id' => 'required',

                    'hospital_id' => 'required',

                ]);

            $date = $_GET['date'];
            $date = date('Y-m-d', strtotime($date));
            $this->data['date'] = $date;
            $service_id = $_GET['service_id'];
            $hospital_id = $_GET['hospital_id'];
            $this->data['hospital_id'] = $hospital_id;
            $this->data['service_id'] = $service_id;
            // $user->created_by ='0';
            $dates = DB::table('dentist_calanders')
                ->where('end_date', '>', $date)
                ->where('hospital_id', '=', $hospital_id)
                ->where('service_id', '=', $service_id)
                ->where('start_date', '=', $date)
                ->get();
            //$this->data['times']=$dates;
            $nameOfDay = date('l', strtotime($date));
//echo $nameOfDay;
            $this->data['times'] = "";


            foreach ($dates as $datex) {
                /*$this->data['times']= DB::table('dentist_calanders')
                 ->select("dentist_calanders.*")
                 /*->select(DB::raw('*, max(id) as id'))*/
                /*->where('day','=',$nameOfDay)
               ->groupBy('start_time')

                ->get();*/
                $this->data['times'] = Dentist_calander::orderBy('id', 'desc')
                    ->select('dentist_calanders.*', DB::raw('group_concat(dentist_id) as dentist_id'))
                    ->where('day', '=', $nameOfDay)
                    ->where('hospital_id', '=', $hospital_id)
                    ->where('service_id', '=', $service_id)
                    ->groupBy('start_time')
                    ->get();
                //	var_dump($dates );
                //
            }
            if ($this->data['times'] == "") {

                $this->data['error'] = "please check another date";
                return redirect('/reservation');
            }
            //$this->data['start']=$_GET['start'];
            //var_dump($xx);
            else {
                $this->data['error'] = "";
            }
            $this->data['other_times'] = "";
            $this->data['other_times'] = Dentist_calander::orderBy('id', 'desc')
                ->select('dentist_calanders.*', DB::raw('group_concat(dentist_id) as dentist_id'))
                ->where('end_date', '>', $date)
                ->where('hospital_id', '=', $hospital_id)
                ->where('service_id', '=', $service_id)
                ->where('start_date', '=', $date)
                ->groupBy('start_time')
                ->get();
            //var_dump($this->data['other_times']);
            return view('event.reservationFormRest', $this->data);
        }

        public function reservationFormGet (request $request)
        {

            /*if($_GET['user']==0){
                    $user_id = Auth::guard('client')->user()->id;
                }else{
                    $user_id = Auth::guard('client')->user()->id;
                    //$follower_id = $request->follower_id;

                }*/
            $this->validate($request,
                [
                    'service_id' => 'required',

                    'hospital_id' => 'required',

                ]);

            $date = $_GET['date'];
            $date = date('Y-m-d', strtotime($date));
            $this->data['date'] = $date;
            $service_id = $_GET['service_id'];
            $hospital_id = $_GET['hospital_id'];
            $this->data['hospital_id'] = $hospital_id;
            $this->data['service_id'] = $service_id;
            // $user->created_by ='0';
            $this->data['times'] = Dentist_calander::orderBy('id', 'desc')
                ->select('dentist_calanders.*', DB::raw('group_concat(dentist_id) as dentist_id'))
                ->where('start_date', '=', $date)
                ->where('hospital_id', '=', $hospital_id)
                ->where('service_id', '=', $service_id)
                ->where('status', '=', 0)
                ->groupBy('start_time')
                ->get();


            if ($this->data['times'] == "") {

                $this->data['error'] = "please check another date";
                return redirect('/reservation');
            }
            //$this->data['start']=$_GET['start'];
            //var_dump($xx);
            else {
                $this->data['error'] = "";
            }
            $this->data['other_times'] = "";
            $this->data['other_times'] = Dentist_calander::orderBy('id', 'desc')
                ->select('dentist_calanders.*', DB::raw('group_concat(dentist_id) as dentist_id'))
                ->where('end_date', '>', $date)
                ->where('hospital_id', '=', $hospital_id)
                ->where('service_id', '=', $service_id)
                ->where('start_date', '=', $date)
                ->where('status', '=', 0)
                ->groupBy('start_time')
                ->get();
            //var_dump($this->data['other_times']);
            return view('event.reservationFormRest', $this->data);
        }

        public function reservationFormGetOld (request $request)
        {

            /*if($_GET['user']==0){
                    $user_id = Auth::guard('client')->user()->id;
                }else{
                    $user_id = Auth::guard('client')->user()->id;
                    //$follower_id = $request->follower_id;

                }*/
            $this->validate($request,
                [
                    'service_id' => 'required',

                    'hospital_id' => 'required',

                ]);

            $date = $_GET['date'];
            $date = date('Y-m-d', strtotime($date));
            $this->data['date'] = $date;
            $service_id = $_GET['service_id'];
            $hospital_id = $_GET['hospital_id'];
            $this->data['hospital_id'] = $hospital_id;
            $this->data['service_id'] = $service_id;
            // $user->created_by ='0';
            $dates = DB::table('dentist_calanders')
                ->where('start_date', '<', $date)
                ->where('end_date', '>', $date)
                ->where('hospital_id', '=', $hospital_id)
                ->where('service_id', '=', $service_id)
                ->get();
            //$this->data['times']=$dates;
            $nameOfDay = date('l', strtotime($date));
//echo $nameOfDay;
            $this->data['nameOfDay'] = $nameOfDay;
            $this->data['times'] = "";


            foreach ($dates as $datex) {
                /*$this->data['times']= DB::table('dentist_calanders')
                 ->select("dentist_calanders.*")
                 /*->select(DB::raw('*, max(id) as id'))*/
                /*->where('day','=',$nameOfDay)
               ->groupBy('start_time')

                ->get();*/
                $this->data['times'] = Dentist_calander::orderBy('id', 'desc')
                    ->select('dentist_calanders.*', DB::raw('group_concat(dentist_id) as dentist_id'))
                    ->where('start_date', '<', $date)
                    ->where('end_date', '>', $date)
                    ->where('hospital_id', '=', $hospital_id)
                    ->where('service_id', '=', $service_id)
                    ->groupBy('dentist_id')
                    ->get();

                //
            }
            if ($this->data['times'] == "") {

                $this->data['error'] = "please check another date";
                return redirect('/reservation');
            }
            //$this->data['start']=$_GET['start'];
            //var_dump($xx);
            else {
                $this->data['error'] = "";
            }

            //var_dump($this->data['other_times']);
            return view('event.reservationFormRest', $this->data);
        }

        public function search ($start, $end, $hospital, $service, $date, $dentist)

        {
            if (!Auth::guard('client')->check()) {
                return redirect('cLogin');
                //   return redirect(session('link'));

                //   return redirect(URL::previous());
            }

            $user_name = Auth::guard('client')->user()->name;
            $user_id = Auth::guard('client')->user()->id;
            $followers = DB::table('followers')
                ->where('user_id', $user_id)
                ->get();
            $service_name = DB::table('services')
                ->where('id', $service)
                ->get();
            $hospital_name = DB::table('hospitals')
                ->where('id', $hospital)
                ->get();
            $check_user = DB::table('events')
                ->where('user_id', $user_id)
                ->where('event_date', $date)
                ->where('start_time', $start)
                ->where('hospital_id', $hospital)
                ->where('treatment_id', $service)
                ->get();
            //  var_dump($check_user);
            //  exit();
            if (count($check_user)) {

                return redirect('NotValid');
            }
            $check_user2 = DB::table('events')
                ->where('event_date', $date)
                ->where('start_time', $start)
                ->where('hospital_id', $hospital)
                ->where('treatment_id', $service)
                ->where(function ($query) {
                    $query->where('status', 1)
                        ->orwhere('status', 2)
                        ->orwhere('status', 5);

                })
                ->get();
            //  var_dump($check_user);
            //  exit();
            if (count($check_user2)) {

                return redirect('NotValid');
            }
            //$service_name=$service_name['service_name_ar'];
            //echo $segment = Request::segment(1);
//echo $request->route('start');
            return view('event.reservationFormFinish', ['start' => $start, 'end' => $end, 'hospital' => $hospital, 'service' => $service, 'date' => $date, 'dentist' => $dentist, 'service_name' => $service_name, 'hospital_name' => $hospital_name, 'user_name' => $user_name, 'followers' => $followers]);

        }

        public function notValid ()
        {
            return view('event.notValid');

        }

        public function store (request $request)
        {

            $event = new Event;

            $validator = $this->validate($request,
                [
                    'user' => 'required',
                    'follower_id' => 'required_if:user,==,1'

                ]);
            /*$errors = $validator->errors();
        if($errors) {

exit();
return Redirect::back()->withErrors($errors);
}*/
            //	$event->user_id = Auth::guard('client')->user()->id;
            if ($request->user == 0) {
                $event->user_id = Auth::guard('client')->user()->id;
            } else {
                $event->user_id = Auth::guard('client')->user()->id;
                $event->follower_id = $request->follower_id;
                $event->relation = 1;
            }
            $event->start_time = $request->start;
            $event->end_time = $request->end;
            $event->event_date = $request->date;


            $event->treatment_id = $request->service;
            $event->hospital_id = $request->hospital;
            $event->dentist_id = $request->dentist;

            $event->diseases = $request->diseases;

            $event->drugs = $request->drugs;
            $event->description = $request->description;
            if ($request->photo) {
                $name = time() . '.' . $request->photo->getClientOriginalExtension();
                $request->photo->move(public_path('/images'), $name);
                $event->photo = $name;
            }


            // $user->created_by ='0';
            $event->save();
            $request->session()->flash("message", "تم اضافة العضو بنجاح");

            return redirect('/UReservation');
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
        public function accepet (request $request, $id)
        {


            if ($id) {
                $dentist_id = Auth::guard('dentist')->user()->id;
                DB::table('events')
                    ->where('id', $id)
                    ->update(['status' => 1, 'dentist_id' => $dentist_id]);

                // get user info
                // create chat
                $find = Event::find($id);
                if ($find) {
                    $update_dentist = DB::table('dentist_calanders')
                        ->where('hospital_id', $find->hospital_id)
                        ->where('service_id', $find->treatment_id)
                        ->where('start_date', $find->event_date)
                        ->where('dentist_id', $dentist_id)
                        ->update(['status' => 1, 'flag' => 1]);

                    //check another appointemnet for this dector and remove it
                    $event_statuss = DB::table('events')
                        ->where('hospital_id', $find->hospital_id)
                        ->where('treatment_id', $find->treatment_id)
                        ->where('event_date', $find->event_date)
                        ->where('dentist_id', $dentist_id)
                        ->where('status', 0)
                        ->get();
                    // dd($event_statuss);
                    if ($event_statuss) {
                        foreach ($event_statuss as $event_status) {

                            $search = $event_status->dentist_id;
                            //exit();
                            $searchString = ',';

                            if (strpos($search, $searchString) !== false) {
                                //	if (is_array($event_status->dentist_id)){
                                //$dentist_id=$request->dentist_id;
                                //	$key = array_search($id, $search); // $key = 2;

                                $array = str_replace($dentist_id, "", $search);
                                $array = str_replace(',,', ',', $array);

                                $array = trim($array, ',');

                                //   $array=  array_splice($search,$key);
                                DB::table('events')
                                    ->where('id', $event_status->id)
                                    ->update(['status' => 0, 'dentist_id' => $array]);

                            } else {


                                Event::find($event_status->id)->delete();


                            }
                        }
                    }

                    $dentist = Dentist::find($find->dentist_id);
                    $find->update(['status' => 1]);
                    $thread = Thread::create(['subject' => 'محادثةدكتور' . $dentist->name, 'start_date' => Carbon::now()->format('Y-m-d'), 'end_date' => $find->event_date]);
                    // Message
                    $message = Message::create(['thread_id' => $thread->id, 'user_id' => $find->dentist_id, 'type' => 1, 'body' => 'مرحبا بك',]);
                    // Sender
                    Participant::create(['thread_id' => $thread->id, 'user_id' => $find->user_id, 'type' => '2', 'last_read' => Carbon::now()->format('Y-m-d'),]);
                    Participant::create(['thread_id' => $thread->id, 'user_id' => $find->dentist_id, 'type' => '1', 'last_read' => Carbon::now()->format('Y-m-d'),]);
                    $request->session()->flash('meassage', 'good');


                    $data = DB::table('users')
                        ->join('events', 'users.id', '=', 'events.user_id')
                        ->where('events.id', $id)->first();

                    //     Mail::to($data->email)->send(new SendMail($data));

                }
            }


            // $user->created_by ='0';

            return redirect('/dUAReservation');
        }

        public function userAccepet (request $request, $id)
        {


            if ($id) {
                $user_id = Auth::guard('client')->user()->id;
                DB::table('events')
                    ->where('id', $id)
                    ->update(['status' => 2]);

                // get user info
                // create chat

            }


            // $user->created_by ='0';

            return redirect('/UAReservation');
        }

        public function neglect (request $request, $id)
        {

            if ($id) {
                $dentist_id = Auth::guard('dentist')->user()->id;
                $event_status = Event::where('id', $id)->first();
                //dd($event_status);

                $scudual = Dentist_calander::where('dentist_id',$dentist_id)->where('service_id',$event_status->treatment_id)->first()->update([
                    'status'=>0,
                    'flag'=>0
                ]);
                /*DB::table('events')

                  ->where('id', $id)
                 ->update(['status'=>3]);*/

                // get user info
                /*$data=	DB::table('users')
                ->join('events', 'users.id', '=', 'events.user_id')
                  ->where('events.id', $id)->first();
                 */
                //  Mail::to($data->email)->send(new SendMailCancel ($data));

                if ($event_status) {
                    $search = $event_status->dentist_id;
                    //exit();
                    $searchString = ',';

                    if (strpos($search, $searchString) !== false) {
                        //	if (is_array($event_status->dentist_id)){
                        //$dentist_id=$request->dentist_id;
                        //	$key = array_search($id, $search); // $key = 2;

                        $array = str_replace($dentist_id, "", $search);
                        $array = str_replace(',,', ',', $array);

                        $array = trim($array, ',');

                        //   $array=  array_splice($search,$key);
                        DB::table('events')
                            ->where('id', $id)
                            ->update(['status' => 0, 'dentist_id' => $array]);

                    } else {


                        Event::find($id)->delete();


                    }
                }
            }

            //

            // $user->created_by ='0';

            return redirect('/dUAReservation');
        }

        public function userNeglect (request $request, $id)
        {


            if ($id) {
                $user_id = Auth::guard('client')->user()->id;
                $event_status = Event::where('id', $id)
                    ->first();
                if ($event_status->status == 0) {
                    Event::find($id)->delete();

                } else {
                    DB::table('events')
                        ->where('id', $id)
                        ->update(['status' => 4]);
                    $update_dentist = DB::table('dentist_calanders')
                        ->where('hospital_id', $event_status->hospital_id)
                        ->where('service_id', $event_status->treatment_id)
                        ->where('start_date', $event_status->event_date)
                        ->where('dentist_id', $event_status->dentist_id)
                        ->update(['status' => 0]);
                    // get user info
                    // create chat


                }


                // $user->created_by ='0';

                return redirect('/UAReservation');
            }
        }

        public function approveArrival (request $request, $id)
        {

            //status 3 confrim arrival
            if ($id) {
                $date = date("Y-m-d");
                DB::table('events')
                    ->where('id', $id)
                    ->where('event_date', '=', $date)
                    ->orwhere('event_date', '>', $date)
                    ->update(['status' => 5]);
                $message = (app()->getLocale() == 'en') ? "Arrival has been confirmed successfully" : "تم تأكيد الوصول";
                Session::flash("message", $message);

            }

            //


            // $user->created_by ='0';

            return redirect('/dUAReservation');
        }

        public function details ($id)
        {

            if (!Auth::guard('client')->check()) {
                return redirect('cLogin');
                //   return redirect(session('link'));

                //   return redirect(URL::previous());
            }
            //status 3 confrim arrival
            if ($id) {
                $this->data['object'] = DB::table('events')
                    ->select("events.*", "events.id As event_id", "events.photo As event_photo", "dentists.*", "dentists.name As D_name", "hospitals.*", "services.*", "users.name As Uname")
                    ->join('services', 'events.treatment_id', '=', 'services.id')
                    ->join('dentists', 'events.dentist_id', '=', 'dentists.id')
                    ->join('hospitals', 'events.hospital_id', '=', 'hospitals.id')
                    ->join('users', 'events.user_id', '=', 'users.id')
                    ->where('events.id', $id)
                    ->get();
                //var_dump($this->data['object']);
                $follower = "";
                if ($this->data['object'][0]->follower_id != "") {
                    $follower = DB::table('followers')
                        ->where('followers.id', $this->data['object'][0]->follower_id)
                        ->get();
                }
                $this->data['follower'] = $follower;
                return view('client.details', $this->data);
            }


        }

        public function detailsD ($id)
        {

            if (!Auth::guard('dentist')->check()) {
                return redirect('dLogin');
                //   return redirect(session('link'));

                //   return redirect(URL::previous());
            }
            //status 3 confrim arrival
            if ($id) {
                $this->data['object'] = DB::table('events')
                    ->select("events.*", "events.id As event_id", "events.photo As event_photo", "dentists.*", "dentists.name As D_name", "hospitals.*", "services.*", "users.name As Uname")
                    ->join('services', 'events.treatment_id', '=', 'services.id')
                    ->join('dentists', 'events.dentist_id', '=', 'dentists.id')
                    ->join('hospitals', 'events.hospital_id', '=', 'hospitals.id')
                    ->join('users', 'events.user_id', '=', 'users.id')
                    ->where('events.id', $id)
                    ->get();
                //var_dump($this->data['object']);
                $follower = "";
                if ($this->data['object'][0]->follower_id != "") {
                    $follower = DB::table('followers')
                        ->where('followers.id', $this->data['object'][0]->follower_id)
                        ->get();
                }
                $this->data['follower'] = $follower;
                return view('client.details', $this->data);
            }


        }
    }