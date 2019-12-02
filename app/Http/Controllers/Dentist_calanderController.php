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

    class Dentist_calanderController extends Controller
    {

        public function showCalanderForm ()
        {
            if (!Auth::guard('dentist')->check()) {
                return redirect('dLogin');
            }
            $dentist_id = Auth::guard('dentist')->user()->id;
            $datas = DB::table('dentist_calanders')->where('dentist_id', '=', $dentist_id)->groupBy('day')->get();
            //dd($datas);
            $day_data = "";
            if (!empty($datas)) {
                foreach ($datas as $date) {
                    $day_data = DB::table('dentist_calanders')->where('dentist_id', '=', $dentist_id)->where('day', '=', "$date->day")->get();
                }
                $day_data;
            }
            $services = Service::all();
            //	$hospitals = Hospital::all();
            $hospital_id = Auth::guard('dentist')->user()->hospital;

            return view('vendor.add_calander')->with(['services' => $services, 'hospital_id' => $hospital_id, "datas" => $datas, 'day_data' => $day_data]);
        }//


        public function calanderAction (Request $request)
        {
            if ($request->period) {
                $this->validate($request,
                    [


                        'period' => 'sometimes',
                        'day' => 'required|not_in:0',

                        'end_date' => 'required_if:period,on|date|after_or_equal:start_date',

                    ]);
                $thisDatex = "";
                $startTime = strtotime($request->start_date);
                $endTime = date(strtotime($request->end_date));
                for ($i = $startTime; $i <= $endTime; $i = $i + 86400) {
                    $thisDate = date('l', $i);
                    // $thisDate = date( 'Y-m-d', $i ); // 2010-05-01, 2010-05-02, etc
                    if ($thisDate == $request->day) {
                        $thisDate = date('Y-m-d', $i);
                        //	$thisDatex[]= date( 'Y-n-j', $i );

                    }
                }
                if (!$thisDate) {
                    $error_message = (app()->getLocale() == 'en') ? "please select day in the period" : "برجاء تحديد اليوم بين الفترة المختاره";
                    Session::flash('error_message', $error_message);
                    return redirect('/add_calander');

                }
            }

            /*date|after_or_equal:start_date
                 */

            if ($request->day == '0') {
                //      echo $request->day.'p';
                //	exit();
                $client = new Dentist_calander;
                $client->dentist_id = Auth::guard('dentist')->user()->id;
                $client->service_id = $request->service_id;
                $client->hospital_id = $request->hospital_id;
                $client->start_date = Carbon::parse($request->start_date)->format('Y-m-d');
                $client->end_date = date('Y-m-d', strtotime("+1 day", strtotime($request->start_date)));
                $client->day = date('l', strtotime($request->start_date));
                $client->start_time = $request->start_time;
                $client->end_time = $request->end_time;
                $client->save();
            } else {

                //      $start_date = date('Y-m-d',strtotime("-1 day", strtotime($request->start_date)));
                $start_date = date('Y-m-d', strtotime($request->start_date));
                //$start_date =  strtotime($request->start_date);
                $end_date = strtotime($request->end_date);
                $begin = new DateTime($start_date);
                $end = new DateTime($request->end_date);
                //for ($i=$start_date; $i<=$end_date; $i++)  {
                // ini_set('max_execution_time', 0);

                for ($i = $begin; $i <= $end; $i->modify('+1 day')) {
                    //		      echo $request->day;
                    //	exit();
                    //	 $date= date('Y-m-d', strtotime("+1 day", strtotime($i->format("Y-m-d"))));
                    $date = date('Y-m-d', strtotime($i->format("Y-m-d")));
                    $date2 = date('Y-m-d', strtotime("+1 day", strtotime($date)));
                    $dayName = date('l', strtotime($date));
                    //  echo "<br/>";
                    if ($request->day == $dayName) {
                        //	 echo $dayName;
                        //	 exit();
                        $client = new Dentist_calander;
                        $client->dentist_id = Auth::guard('dentist')->user()->id;
                        $client->service_id = $request->service_id;
                        $client->hospital_id = $request->hospital_id;
                        $client->start_date = $date;
                        $client->end_date = $date2;
                        $client->day = $dayName;
                        $client->start_time = $request->start_time;
                        $client->end_time = $request->end_time;
                        $client->save();
                    }

                }

            }

            //echo $request->day;
            //exit();
            /*if($request->day=="0"){
             $client->day =	date('l', strtotime($request->start_date));

            }else{

            $client->day = $request->day;
            }
            */


            //  $client->save();
            $message = (app()->getLocale() == 'en') ? "successfully Added" : "تم التسجيل بنجاح";
            Session::flash('message', $message);

            return redirect('/add_calander');
            //   }


        }

        public function calander ($id)
        {
            if (!Auth::guard('dentist')->check()) {
                return redirect('dLogin');
            }
            $dentist_id = Auth::guard('dentist')->user()->id;
            $object = DB::table('dentist_calanders')
                ->where('id', '=', $id)
                ->first();
            //dd($datas);

            $services = Service::all();
            $hospitals = Hospital::all();
            //echo	$dentist_id = Auth::guard('dentist')->user()->name;
            return view('vendor.edit_calander')->with(['services' => $services, 'hospitals' => $hospitals, "object" => $object]);
        }//

        public function UpdateCalander (Request $request, $id)
        {

            if ($request->period) {
                $this->validate($request,
                    [


                        'period' => 'sometimes',

                        'day' => 'required_if:period,on',
                        'end_date' => 'required_if:period,on|date|after_or_equal:start_date',

                    ]);
            }

            /*while ($request->start_date <= $request->end_date) {
                 $dayName=date('l', strtotime($request->start_date));
                if ($request->day == $dayName) {
                    $sundays[] = $startDate->format('Y-m-d');
                }*/

            $client = Dentist_calander::find($id);

            $client->dentist_id = Auth::guard('dentist')->user()->id;
            $client->service_id = $request->service_id;

            $client->start_date = Carbon::parse($request->start_date)->format('Y-m-d');
            if ($request->end_date == "") {
                $client->end_date = date('Y-m-d', strtotime("+1 day", strtotime($request->start_date)));

            } else {

                $client->end_date = $request->end_date;
            }
            $client->start_time = $request->start_time;

            /* $client->day = $request->day;*/
            $client->day = date('l', strtotime($request->start_date));


            $client->update();
            if ($client) {
                //	echo 'd';

                $message = (app()->getLocale() == 'en') ? "successfully Added" : "تم التسجيل بنجاح";
                Session::flash('message', $message);


                return redirect('/add_calander');
            }


        }

        public function destroy ($id)
        {

            Dentist_calander::find($id)->delete();

            return redirect()->back();
        }
    }
