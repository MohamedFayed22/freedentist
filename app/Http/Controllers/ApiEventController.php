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

    class ApiEventController extends Controller
    {

        public function Upcoming_Reserv (request $request)
        {


            $date = date("Y-m-d");


            $data = Event::where('user_id', $request->user_id)
                ->where(function ($query) use ($date) {
                    $query->where('event_date', '>', $date)
                        ->orwhere('event_date', '=', $date);

                })
                ->where(function ($query) {
                    $query->where('status', 1)
                        ->orwhere('status', 2)
                        ->orwhere('status', 0);
                })
                ->get();
            //	var_dump($data);
            if (sizeof($data) != 0) {


                foreach ($data as $d) {


                    $day_data = DB::table('events')
                        ->select("events.*", "events.id As events_id", "followers.*", "followers.name As follower_name", "users.name As user_name", "dentists.*", "dentists.name As Dentist_name", "hospitals.*", "services.*")
                        ->join('services', 'events.treatment_id', '=', 'services.id')
                        ->leftJoin('followers', 'events.follower_id', '=', 'followers.id')
                        ->leftJoin('dentists', function ($query) {
                            $query->whereRaw("find_in_set(events.dentist_id,dentists.id)");
                        })
                        ->join('users', 'events.user_id', '=', 'users.id')
                        ->join('hospitals', 'events.hospital_id', '=', 'hospitals.id')
                        ->where('events.user_id', $request->user_id)
                        ->where(function ($query) use ($date) {
                            $query->where('event_date', '>', $date)
                                ->orwhere('event_date', '=', $date);

                        })
                        ->where(function ($query) {
                            $query->where('status', 1)
                                ->orwhere('status', 2)
                                ->orwhere('status', 0);
                        })
                        ->get();
                    /*	 }




            else{


                        $day_data = DB::table('events')
                            ->select("events.*","events.id As events_id","users.name As u_name","dentists.name As Dentist_name","hospitals.*","services.*")
                        ->join('services', 'events.treatment_id', '=', 'services.id')
                        ->join('dentists', 'events.dentist_id', '=', 'dentists.id')
                        ->join('users', 'events.user_id', '=', 'users.id')

                        ->join('hospitals', 'events.hospital_id', '=', 'hospitals.id')

                        ->where(function ($query) use ($date) {
                           $query->where('event_date','>',$date)
                                ->orwhere('event_date','=',$date);

                       })

                    ->where('events.user_id',$request->user_id)

                        ->get();
                    //	var_dump($day_data);
                     // $this->data['Next_Dates'][] = $day_data;



                    }*/
                }
                //if( sizeof($day_data) != 0 ) {

                return response()->json(['data' => $day_data, 'status' => 'success']);
            } else {
                return response()->json(['status' => 'Not found']);
            }
        }

        public function prev_Reserv (request $request)
        {


            $date = date("Y-m-d");

            $data = Event::where('user_id', $request->user_id)->where(function ($query) use ($date) {
                $query->where('event_date', '<', $date)
                    ->orwhere('status', 5)
                    ->orwhere('status', 3)
                    ->orwhere('status', 4);

            })
                ->get();
            if (sizeof($data) != 0) {


                foreach ($data as $d) {


                    $day_data = DB::table('events')
                        ->select("events.*", "events.id As events_id", "followers.*", "followers.name As follower_name", "users.name As user_name", "dentists.*", "dentists.name As Dentist_name", "hospitals.*", "services.*")
                        ->join('services', 'events.treatment_id', '=', 'services.id')
                        ->leftJoin('followers', 'events.follower_id', '=', 'followers.id')
                        ->join('dentists', 'events.dentist_id', '=', 'dentists.id')
                        ->join('users', 'events.user_id', '=', 'users.id')
                        ->join('hospitals', 'events.hospital_id', '=', 'hospitals.id')
                        ->where('events.user_id', $request->user_id)
                        ->where(function ($query) use ($date) {
                            $query->where('event_date', '<', $date)
                                ->orwhere('status', 5)
                                ->orwhere('status', 3)
                                ->orwhere('status', 4);
                        })
                        ->get();
                }


                return response()->json(['data' => $day_data, 'status' => 'success']);
            } else {
                return response()->json(['status' => 'Not found']);
            }
        }

        //upcoming accepted reservation for dentist
        public function Upcoming_Reserv_acceptedD (request $request)
        {

            $c_dentist = $request->dentist_id;
            $date = date("Y-m-d");
            $data = Event::where('dentist_id', $request->dentist_id)
                ->where('status', 1)
                ->where(function ($query) use ($date) {
                    $query->where('event_date', '>', $date)
                        ->orwhere('event_date', '=', $date);

                })
                ->get();
            //dd($data);
            //$this->data['events'] = $data;
            if (sizeof($data) != 0) {


                foreach ($data as $d) {


                    $day_data = DB::table('events')
                        ->select("events.*", "events.id As events_id", "followers.*", "followers.name As follower_name", "users.name As user_name", "hospitals.*", "services.*")
                        ->join('services', 'events.treatment_id', '=', 'services.id')
                        ->leftJoin('followers', 'events.follower_id', '=', 'followers.id')
                        ->join('users', 'events.user_id', '=', 'users.id')
                        ->join('hospitals', 'events.hospital_id', '=', 'hospitals.id')
                        ->where(function ($query) use ($date) {
                            $query->where('event_date', '>', $date)
                                ->orwhere('event_date', '=', $date);

                        })
                        ->where('status', 1)
                        ->where('dentist_id', $request->dentist_id)
                        ->get();

                    $this->data['Next_Dates_Approved'][] = $day_data;


                }

                return response()->json(['data' => $this->data, 'status' => 'success']);
            } else {
                return response()->json(['status' => 'Not found']);
            }
        }

        public function Upcoming_Reserv_D (request $request)
        {

            $c_dentist = $request->dentist_id;
            $date = date("Y-m-d");
            $data = Event::where(function ($query) use ($date) {
                $query->where('event_date', '>', $date)
                    ->orwhere('event_date', '=', $date);

            })
                ->where(function ($query) {
                    $query->where('status', 1)
                        ->orwhere('status', 2)
                        ->orwhere('status', 0);
                })
                ->whereRaw("find_in_set($c_dentist,dentist_id)")->get();
            //$this->data['events'] = $data;
            if (sizeof($data) != 0) {

                foreach ($data as $d) {

                    //$treatments = Service::where('id',$d->treatment_id)->first();


                    $day_data = DB::table('events')
                        ->select("events.*", "events.id As events_id", "followers.*", "followers.name As follower_name", "users.name As user_name", "hospitals.*", "services.*")
                        ->join('services', 'events.treatment_id', '=', 'services.id')
                        ->leftJoin('followers', 'events.follower_id', '=', 'followers.id')
                        ->join('hospitals', 'events.hospital_id', '=', 'hospitals.id')
                        ->join('users', 'events.user_id', '=', 'users.id')
                        ->where(function ($query) use ($date) {
                            $query->where('event_date', '>', $date)
                                ->orwhere('event_date', '=', $date);

                        })
                        ->where(function ($query) {
                            $query->where('status', 1)
                                ->orwhere('status', 2)
                                ->orwhere('status', 0);
                        })
                        ->whereRaw("find_in_set($c_dentist,dentist_id)")
                        ->get();

                    //    $this->data['previous_Dates'] = $day_data;


                }

                return response()->json(['data' => $day_data, 'status' => 'success']);
            } else {
                return response()->json(['status' => 'Not found']);
            }
        }

        public function prev_ReservD (request $request)
        {
            $date = date("Y-m-d");
            $c_dentist = $request->dentist_id;
            $data = Event::where('dentist_id', $request->dentist_id)
                ->where(function ($query) use ($date) {
                    $query->where('event_date', '<', $date)
                        ->orwhere('status', 5)
                        ->orwhere('status', 3)
                        ->orwhere('status', 4);

                })->get();
            //$this->data['events'] = $data;
            if (sizeof($data) != 0) {

                foreach ($data as $d) {

                    //$treatments = Service::where('id',$d->treatment_id)->first();


                    $day_data = DB::table('events')
                        ->select("events.*", "events.id As events_id", "followers.*", "followers.name As follower_name", "users.name As user_name", "hospitals.*", "services.*")
                        ->join('services', 'events.treatment_id', '=', 'services.id')
                        ->leftJoin('followers', 'events.follower_id', '=', 'followers.id')
                        ->join('users', 'events.user_id', '=', 'users.id')
                        ->join('hospitals', 'events.hospital_id', '=', 'hospitals.id')
                        ->whereRaw("find_in_set($c_dentist,dentist_id)")
                        ->where(function ($query) use ($date) {
                            $query->where('event_date', '<', $date)
                                ->orwhere('status', 5)
                                ->orwhere('status', 3)
                                ->orwhere('status', 4);
                        })
                        ->get();
                    //    $this->data['previous_Dates'] = $day_data;


                }

                return response()->json(['data' => $day_data, 'status' => 'success']);
            } else {
                return response()->json(['status' => 'Not found']);
            }
        }

        //pending upcoming reservation
        public function pending_ReservD (request $request)
        {

            /*->orwhere('end_date','=',Now())*/
            $data = Event::where('event_date', '>', Now())->where('status', 0)->where('dentist_id', $request->dentist_id)->orwhere('event_date', '=', Now())->get();
            //$this->data['events'] = $data;
            if (!empty($data)) {


                foreach ($data as $d) {

                    if ($d->follower_id != "") {

                        $day_data = DB::table('events')
                            ->select("events.*", "events.id As events_id", "followers.*", "followers.name As u_name", "hospitals.*", "services.*")
                            ->join('services', 'events.treatment_id', '=', 'services.id')
                            ->join('followers', 'events.follower_id', '=', 'followers.id')
                            ->join('hospitals', 'events.hospital_id', '=', 'hospitals.id')
                            ->where('event_date', '>', Now())->where('status', 0)->where('dentist_id', $request->dentist_id)->get();

                        $this->data['pending_Dates'][] = $day_data;
                    } else {
                        $day_data = DB::table('events')
                            ->select("events.*", "events.id As events_id", "users.*", "users.name As u_name", "hospitals.*", "services.*")
                            ->join('services', 'events.treatment_id', '=', 'services.id')
                            ->join('users', 'events.user_id', '=', 'users.id')
                            ->join('hospitals', 'events.hospital_id', '=', 'hospitals.id')
                            ->where('event_date', '>', Now())->where('status', 0)->where('dentist_id', $request->dentist_id)->get();
                        $this->data['pending_Dates'][] = $day_data;
                    }


                }

                return response()->json(['data' => $this->data, 'status' => 'success']);
            } else {
                return response()->json(['status' => 'No pending Reservation']);
            }
        }

        public function reservationFormGet (request $request)
        {


            $date = $request->input('date');
            $date = date('Y-m-d', strtotime($date));
            $this->data['date'] = $date;
            $service_id = $request->input('service_id');
            $hospital_id = $request->input('hospital_id');
            $this->data['hospital_id'] = $hospital_id;
            $this->data['service_id'] = $service_id;
            // $user->created_by ='0';
            $dates = Dentist_calander::orderBy('id', 'desc')
                ->select('dentist_calanders.*', DB::raw('group_concat(dentist_id) as dentist_id'))
                ->where('start_date', '=', $date)
                ->where('end_date', '>', $date)
                ->where('hospital_id', '=', $hospital_id)
                ->where('service_id', '=', $service_id)
                ->groupBy('start_date')
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

               /* ->get();*/
                /*$check_user2=DB::table('events')


                 ->where('event_date', $date)
                 ->where('hospital_id', $hospital_id)
                 ->where('treatment_id', $service_id)
                 ->where(function ($query)  {
                  $query->where('status', 1)
                       ->orwhere('status',2)
                       ->orwhere('status',5);

              })

                 ->get();
                 if(count($check_user2)){

                 return response()->json(['status'=>'Not Valid']);
                 }*/
                $this->data['times'] = Dentist_calander::orderBy('id', 'desc')
                    ->select('dentist_calanders.*', DB::raw('group_concat(dentist_id) as dentist_id'))
                    ->where('day', '=', $nameOfDay)
                    ->where('start_date', '=', $date)
                    ->where('hospital_id', '=', $hospital_id)
                    ->where('service_id', '=', $service_id)
                    ->groupBy('start_date')
                    ->get();
            }
            if ($this->data['times'] == "") {

                return response()->json(['status' => 'please check another date']);

            }
            //$this->data['start']=$_GET['start'];
            //var_dump($xx);

            return response()->json(['data' => $this->data, 'status' => 'success']);

        }

        public function search ($start, $end, $hospital, $service, $date, $dentist)

        {

            $user_name = Auth::guard('api')->user()->name;

            $service_name = DB::table('services')
                ->where('id', $service)
                ->get();
            $hospital_name = DB::table('hospitals')
                ->where('id', $hospital)
                ->get();
            //$service_name=$service_name['service_name_ar'];
            //echo $segment = Request::segment(1);
//echo $request->route('start');
//return response()->json(['data'=>$this->data,'success']);
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

                return response()->json(['status' => 'Not Valid']);
            }

            return response()->json(['status' => 'success', 'start' => $start, 'end' => $end, 'hospital' => $hospital, 'service' => $service, 'date' => $date, 'dentist' => $dentist, 'service_name' => $service_name, 'hospital_name' => $hospital_name, 'user_name' => $user_name]);

        }

        public function store (request $request)
        {

            $event = new Event;
            if ($request->user == 0) {
                $event->user_id = $request->user_id;

            } else {
                $event->user_id = $request->user_id;
                $event->follower_id = $request->follower_id;
                $event->relation = 1;
            }
            //$event->user_id = $request->user_id;
            $event->start_time = $request->time;

            $event->event_date = $request->date;
            $event->device_id = $request->device_id;


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
            $event_id = $event->id;
            $str = $request->input('dentist');
            $arr = explode(",", $str);
            //print_r($arr);
            define('API_ACCESS_KEY', 'AAAAyrUJeek:APA91bHTUC8yJw56Lz0eKVgetNqv39SaypZJSgvZ-XNwbAIf-0BEkzJ9Hm8XC6zjvF_BB8lKVjPIv-H_jYbmNrKZQeyIQRWE9O07oGddAVNEkn3fGuAdL7pQge3e-QSqpHARf-5U1zkq');
            $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
            foreach ($arr as $i) {
                //	echo $i;
                $event = DB::table('events')
                    ->select("events.*", "events.id As event_id", "services.*")
                    ->join('services', 'events.treatment_id', '=', 'services.id')
                    ->where('events.id', $event_id)
                    ->get();
                $dentist = Dentist::where('id', $i)
                    ->first();
                $notification = new User_notification;
                $notification->dentist_id = $i;
                $notification->service_id = $event[0]->treatment_id;
                $notification->event_id = $event_id;
                $notification->title = 'طبيب اسنان مجاني';
                $notification->mesg = 'لديك حجز موعد بانتظار اعتمادك';
                $notification->save();

                $token = $dentist->device_id;

                $notification = [

                    'body' => 'لديك حجز موعد بانتظار اعتمادك #.' . $event_id . ' بتاريخ ' . $event[0]->event_date . ' لخدمة ' . $event[0]->service_name_ar . ' الساعة ' . $event[0]->start_time,
                    'sound' => 'default',
                ];
                $extraNotificationData = ["message" => $notification, "event_id" => $event_id];

                $fcmNotification = [
                    //'registration_ids' => $tokenList, //multple token array
                    'to' => $token, //single token
                    'notification' => $notification,
                    'data' => $extraNotificationData
                ];

                $headers = [
                    'Authorization: key=' . API_ACCESS_KEY,
                    'Content-Type: application/json'
                ];


                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $fcmUrl);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
                $result = curl_exec($ch);
                curl_close($ch);


            }
            return $result;
            //  return response()->json(['status'=>'success']);

        }

        public function accepet (request $request)
        {
            $dentist_id = $request->dentist_id;
            $event_id = $request->event_id;
            $update = DB::table('events')
                ->where('id', $event_id)
                ->where('status', 0)
                ->update(['status' => 1, 'notification' => 1, 'dentist_id' => $dentist_id]);
            if ($update) {

                // get user info
                // create chat
                $find = Event::find($event_id);
                if ($find) {
                    $update_dentist = DB::table('dentist_calanders')
                        ->where('hospital_id', $find->hospital_id)
                        ->where('service_id', $find->treatment_id)
                        ->where('start_date', $find->event_date)
                        ->where('dentist_id', $dentist_id)
                        ->update(['status' => 1, 'flag' => 1]);
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

                    $dentist = Dentist::find($dentist_id);

                    $thread = Thread::create(['subject' => ' محادثة  دكتور ' . $dentist->name, 'start_date' => Carbon::now()->format('Y-m-d'), 'end_date' => $find->event_date]);
                    // Message
                    $message = Message::create(['thread_id' => $thread->id, 'user_id' => $dentist_id, 'type' => 1, 'body' => 'مرحبا يمكنك بدأ المحادثة',]);
                    // Sender
                    Participant::create(['thread_id' => $thread->id, 'user_id' => $find->user_id, 'type' => '2', 'last_read' => Carbon::now()->format('Y-m-d'),]);
                    Participant::create(['thread_id' => $thread->id, 'user_id' => $find->dentist_id, 'type' => '1', 'last_read' => Carbon::now()->format('Y-m-d'),]);


                    $event = DB::table('events')
                        ->select("events.*", "events.id As event_id", "services.*")
                        ->join('services', 'events.treatment_id', '=', 'services.id')
                        ->where('events.id', $event_id)
                        ->get();


                    //	  var_dump($event);
                    //API URL of FCM
                    $url = 'https://fcm.googleapis.com/fcm/send';

                    /*api_key available in:
                    Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key*/
                    $api_key = 'AAAAyrUJeek:APA91bHTUC8yJw56Lz0eKVgetNqv39SaypZJSgvZ-XNwbAIf-0BEkzJ9Hm8XC6zjvF_BB8lKVjPIv-H_jYbmNrKZQeyIQRWE9O07oGddAVNEkn3fGuAdL7pQge3e-QSqpHARf-5U1zkq';
                    $message = "لقد تم اعتماد موعدك ";
                    $device_id = $event[0]->device_id;
                    /* $device_id ='fojr2AVSVcg:APA91bFVokcYXHkCREO1c-P78A017vetbyeYJ45F42SwxDApLGLpsqJE6cUpT-lxGRWEFzJ3-lrSunwkqJZ0NoK5EBoYjBxfLAvpNR2FmwmUss3UXQQ0Kx96GfwybA0xn-5pmetBqTvI';     */

                    define('API_ACCESS_KEY', 'AAAAyrUJeek:APA91bHTUC8yJw56Lz0eKVgetNqv39SaypZJSgvZ-XNwbAIf-0BEkzJ9Hm8XC6zjvF_BB8lKVjPIv-H_jYbmNrKZQeyIQRWE9O07oGddAVNEkn3fGuAdL7pQge3e-QSqpHARf-5U1zkq');
                    $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
                    $token = $event[0]->device_id;

                    $notification = [

                        'body' => 'لقد تم اعتماد موعدك #.' . $event_id . ' بتاريخ ' . $event[0]->event_date . ' لخدمة ' . $event[0]->service_name_ar . ' الساعة ' . $event[0]->start_time,
                        'sound' => 'default',

                    ];
                    $extraNotificationData = ["message" => $notification, "event_id" => $event_id];

                    $fcmNotification = [
                        //'registration_ids' => $tokenList, //multple token array
                        'to' => $token, //single token
                        'notification' => $notification,
                        'data' => $extraNotificationData
                    ];

                    $headers = [
                        'Authorization: key=' . API_ACCESS_KEY,
                        'Content-Type: application/json'
                    ];


                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $fcmUrl);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
                    $result = curl_exec($ch);
                    curl_close($ch);

                    $notification = new User_notification;
                    $notification->user_id = $event[0]->user_id;
                    $notification->service_id = $event[0]->treatment_id;
                    $notification->event_id = $event_id;
                    $notification->title = 'طبيب اسنان مجاني';
                    $notification->mesg = 'لقد تم اعتماد موعدك';
                    $notification->save();
                    return $result;


                } else {
                    return response()->json(['status' => 'Error']);
                }
            }


            // $user->created_by ='0';
            //  return response()->json(['status'=>'success']);


        }

        public function userAccepet (request $request, $id)
        {


            //paitient accepet reserv

            //	$event_id = $request->event_id;
            DB::table('events')
                ->where('id', $id)
                ->update(['status' => 2]);
            $event = DB::table('events')
                ->select("events.*", "events.id As event_id", "dentists.*", "services.*")
                ->join('dentists', 'events.dentist_id', '=', 'dentists.id')
                ->join('services', 'events.treatment_id', '=', 'services.id')
                ->where('events.id', $id)
                ->get();
            define('API_ACCESS_KEY', 'AAAAyrUJeek:APA91bHTUC8yJw56Lz0eKVgetNqv39SaypZJSgvZ-XNwbAIf-0BEkzJ9Hm8XC6zjvF_BB8lKVjPIv-H_jYbmNrKZQeyIQRWE9O07oGddAVNEkn3fGuAdL7pQge3e-QSqpHARf-5U1zkq');
            $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
            $token = $event[0]->device_id;

            $notification = [

                'body' => 'لقد تم تأكيد الحضور على موعد#.' . $id . ' بتاريخ ' . $event[0]->event_date . ' لخدمة ' . $event[0]->service_name_ar . ' الساعة ' . $event[0]->start_time,
                'sound' => 'default',


            ];
            $extraNotificationData = ["message" => $notification, "event_id" => $id];

            $fcmNotification = [
                //'registration_ids' => $tokenList, //multple token array
                'to' => $token, //single token
                'notification' => $notification,
                'data' => $extraNotificationData
            ];

            $headers = [
                'Authorization: key=' . API_ACCESS_KEY,
                'Content-Type: application/json'
            ];


            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $fcmUrl);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
            $result = curl_exec($ch);
            curl_close($ch);
            $notification = new User_notification;
            $notification->dentist_id = $event[0]->dentist_id;
            $notification->service_id = $event[0]->treatment_id;
            $notification->event_id = $id;
            $notification->title = 'طبيب اسنان مجاني';
            $notification->mesg = 'لقد تم تأكيد الحضور على موعد';
            $notification->save();

            return $result;


            // $user->created_by ='0';
            //   return response()->json(['status'=>'success']);


        }

        public function neglect (request $request, $id)
        {


            if ($id) {

                $event_status = Event::where('id', $id) ->first();
                if ($event_status->status != 0) {
                    $event_id = $id;
                    $event = DB::table('events')
                        ->select("events.*", "events.id As event_id", "services.*")
                        ->join('services', 'events.treatment_id', '=', 'services.id')
                        ->where('events.id', $event_id)
                        ->get();
                        
                       // dd($event);

                    $event_status = Event::where('id', $id)->first();
//                dd($event_status);

                $scudual = Dentist_calander::where('dentist_id',$event_status->dentist_id)->where('service_id',$event_status->treatment_id)->first()->update([
                    'status'=>0,
                    'flag'=>0
                ]);
                
                        
                    define('API_ACCESS_KEY', 'AAAAyrUJeek:APA91bHTUC8yJw56Lz0eKVgetNqv39SaypZJSgvZ-XNwbAIf-0BEkzJ9Hm8XC6zjvF_BB8lKVjPIv-H_jYbmNrKZQeyIQRWE9O07oGddAVNEkn3fGuAdL7pQge3e-QSqpHARf-5U1zkq');
                    $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
                    $token = $event[0]->device_id;
                    
                  //  dd( $event[0]);

                    $notification = [

                        'body' => 'لقد تم الغاء لموعد#.' . $event_id . ' بتاريخ ' . $event[0]->event_date . ' لخدمة ' . $event[0]->service_name_ar . ' الساعة ' . $event[0]->start_time,
                        'sound' => 'default',

                    ];
                    $extraNotificationData = ["message" => $notification, "event_id" => $event_id];

                    $fcmNotification = [
                        //'registration_ids' => $tokenList, //multple token array
                        'to' => $token, //single token
                        'notification' => $notification,
                        'data' => $extraNotificationData
                    ];
                    
                    
                   // dd($fcmNotification);

                    $headers = [
                        'Authorization: key=' . API_ACCESS_KEY,
                        'Content-Type: application/json'
                    ];


                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $fcmUrl);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
                    $result = curl_exec($ch);
                    curl_close($ch);
                    $notification = new User_notification;
                    $notification->user_id = $event[0]->user_id;
                    $notification->service_id = $event[0]->treatment_id;
                    $notification->event_id = $event_id;
                    $notification->title = 'طبيب اسنان مجاني';
                    $notification->mesg = 'لقد تم الغاء  لموعد';
                    $notification->save();
                    return $result;

                }

                $search = $event_status->dentist_id;
                //exit();
                $searchString = ',';

                if (strpos($search, $searchString) !== false) {
                    //	if (is_array($event_status->dentist_id)){
                    $dentist_id = $request->dentist_id;
                    //	$key = array_search($id, $search); // $key = 2;

                    $array = str_replace($dentist_id, "", $search);
                    $array = str_replace(',,', ',', $array);

                    $array = trim($array, ',');

                    //   $array=  array_splice($search,$key);
                    DB::table('events')
                        ->where('id', $id)
                        ->update(['status' => 0, 'neglect' => 1, 'dentist_id' => $array]);
                        
                 $event_status = Event::where('id', $id)->first();
                //dd($event_status);

                $scudual = Dentist_calander::where('dentist_id',$dentist_id)->where('service_id',$event_status->treatment_id)->first()->update([
                    'status'=>0,
                    'flag'=>0
                ]);

                } else {


                    Event::find($id)->delete();


                }
            }


        }

        public function userNeglect (request $request, $id)
        {

            //paitient negelect reserv
            if ($id) {
                $event_status = Event::where('id', $id)
                    ->first();
                if ($event_status->status == 0) {
                    Event::find($id)->delete();

                } else {
                    // Event::find($id)->delete();
                    DB::table('events')
                        ->where('id', $id)
                        ->update(['status' => 4]);
                    $update_dentist = DB::table('dentist_calanders')
                        ->where('hospital_id', $event_status->hospital_id)
                        ->where('service_id', $event_status->treatment_id)
                        ->where('start_date', $event_status->event_date)
                        ->where('dentist_id', $event_status->dentist_id)
                        ->update(['status' => 0]);
                    $event_id = $id;
                    $event = DB::table('events')
                        ->select("events.*", "events.id As event_id", "dentists.*", "services.*")
                        ->join('dentists', 'events.dentist_id', '=', 'dentists.id')
                        ->join('services', 'events.treatment_id', '=', 'services.id')
                        ->where('events.id', $event_id)
                        ->get();
                    define('API_ACCESS_KEY', 'AAAAyrUJeek:APA91bHTUC8yJw56Lz0eKVgetNqv39SaypZJSgvZ-XNwbAIf-0BEkzJ9Hm8XC6zjvF_BB8lKVjPIv-H_jYbmNrKZQeyIQRWE9O07oGddAVNEkn3fGuAdL7pQge3e-QSqpHARf-5U1zkq');
                    $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
                    $token = $event[0]->device_id;

                    $notification = [

                        'body' => 'لقد تم رفض موعد #.' . $event_id . ' بتاريخ ' . $event[0]->event_date . ' لخدمة ' . $event[0]->service_name_ar . ' الساعة ' . $event[0]->start_time,
                        'sound' => 'default',

                    ];
                    $extraNotificationData = ["message" => $notification, "event_id" => $event_id];

                    $fcmNotification = [
                        //'registration_ids' => $tokenList, //multple token array
                        'to' => $token, //single token
                        'notification' => $notification,
                        'data' => $extraNotificationData
                    ];

                    $headers = [
                        'Authorization: key=' . API_ACCESS_KEY,
                        'Content-Type: application/json'
                    ];


                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $fcmUrl);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
                    $result = curl_exec($ch);
                    curl_close($ch);

                    $notification = new User_notification;
                    $notification->dentist_id = $event[0]->dentist_id;
                    $notification->service_id = $event[0]->treatment_id;
                    $notification->event_id = $event_id;
                    $notification->title = 'طبيب اسنان مجاني';
                    $notification->mesg = 'لقد تم رفض موعد';
                    $notification->save();
                    return $result;
                }


            }


        }

        public function approveArrival (request $request, $id)
        {

            //status 3 confrim arrival
            if ($id) {
                $date = date('Y-m-d');
                DB::table('events')
                    ->where('id', $id)
                    ->where(function ($query) use ($date) {
                        $query->where('event_date', '>', $date)
                            ->orwhere('event_date', '=', $date);

                    })
                    ->update(['status' => 5]);


            }

            $event_id = $id;
            $event = DB::table('events')
                ->select("events.*", "events.id As event_id", "services.*")
                ->join('services', 'events.treatment_id', '=', 'services.id')
                ->where('events.id', $event_id)
                ->get();
            define('API_ACCESS_KEY', 'AAAAyrUJeek:APA91bHTUC8yJw56Lz0eKVgetNqv39SaypZJSgvZ-XNwbAIf-0BEkzJ9Hm8XC6zjvF_BB8lKVjPIv-H_jYbmNrKZQeyIQRWE9O07oGddAVNEkn3fGuAdL7pQge3e-QSqpHARf-5U1zkq');
            $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
            $token = $event[0]->device_id;

            $notification = [

                'body' => 'لقد تم تسجيل وصولك لموعد#.' . $event_id . ' بتاريخ ' . $event[0]->event_date . ' لخدمة ' . $event[0]->service_name_ar . ' الساعة ' . $event[0]->start_time,
                'sound' => 'default',

            ];
            $extraNotificationData = ["message" => $notification, "event_id" => $event_id];

            $fcmNotification = [
                //'registration_ids' => $tokenList, //multple token array
                'to' => $token, //single token
                'notification' => $notification,
                'data' => $extraNotificationData
            ];

            $headers = [
                'Authorization: key=' . API_ACCESS_KEY,
                'Content-Type: application/json'
            ];


            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $fcmUrl);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
            $result = curl_exec($ch);
            curl_close($ch);
            $notification = new User_notification;
            $notification->user_id = $event[0]->user_id;
            $notification->service_id = $event[0]->treatment_id;
            $notification->event_id = $event_id;
            $notification->title = 'طبيب اسنان مجاني';
            $notification->mesg = 'لقد تم تسجيل وصولك لموعد';
            $notification->save();
            echo $result;


        }

        public function details ($id)
        {

            //status 3 confrim arrival
            if ($id) {
                $this->data['object'] = DB::table('events')
                    ->select("events.*", "events.id As event_id", "events.photo As event_photo", "dentists.*", "dentists.name As D_name", "dentists.mobile As D_mobile", "hospitals.*", "services.*", "users.name As Uname", "users.mobile As U_mobile")
                    ->join('services', 'events.treatment_id', '=', 'services.id')
                    ->join('dentists', 'events.dentist_id', '=', 'dentists.id')
                    ->join('hospitals', 'events.hospital_id', '=', 'hospitals.id')
                    ->join('users', 'events.user_id', '=', 'users.id')
                    ->where('events.id', $id)
                    ->get();
                //dd($object);
                $follower = "";
                if ($this->data['object'][0]->follower_id != "") {
                    $follower = DB::table('followers')
                        ->where('followers.id', $this->data['object'][0]->follower_id)
                        ->get();
                }
                $this->data['follower'] = $follower;


                return response()->json(['data' => $this->data, 'status' => 'success']);

            }


        }
    }