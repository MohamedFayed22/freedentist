<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use App\Service;
    use App\per_user;
    use App\Dentist;
    use DB;
    use Auth;
    use Session;

    class ApiServiceController extends Controller
    {

        public function index ()
        {
            $objects = Service::all();
            return response()->json(['data' => $objects, 'status' => 'success']);

        }

        public function hospitalByService (request $request)
        {
            $service_id = $request->service_id;
            $objects = "";
            $objects = DB::table('hospitals')
                ->select("hospitals.*", "hospitals.id As hospital_id", "dentist_calanders.*")
                ->join('dentist_calanders', 'dentist_calanders.hospital_id', '=', 'hospitals.id')
                ->where('dentist_calanders.service_id', $service_id)
                ->groupBy('hospitals.id')
                ->get();
            if ($objects) {

                return response()->json(['data' => $objects, 'status' => 'success']);
            } else {
                return response()->json(['status' => 'لاتوجد مستشفة بها هذة الخدمة']);
            }


        }

        public function hospitals (request $request)
        {

            $objects = DB::table('hospitals')
                ->get();
            if ($objects) {

                return response()->json(['hospitals' => $objects, 'status' => 'success']);
            } else {
                return response()->json(['status' => 'لاتوجد مستشفة بها هذة الخدمة']);
            }


        }

        public function servicesByCode (request $request)
        {
            $code = $request->code;
            $data = Dentist::where('code', '=', $code)->first();
            $dentist_id = $data->id;
            $objects = "";
            $objects = DB::table('services')
                ->select("services.*", "services.id As service_id", "dentist_calanders.*")
                ->join('dentist_calanders', 'dentist_calanders.service_id', '=', 'services.id')
                ->whereRaw("find_in_set($dentist_id,dentist_calanders.dentist_id)")
                ->groupBy('services.id')
                ->get();
            if ($objects) {
                return response()->json(['data' => $objects, 'status' => 'success']);
            } else {
                return response()->json(['status' => 'لاتوجد خدمات لهذا الطبيب']);
            }


        }

        public function searchBycode (Request $request)

        {


            //echo $request->hospital_id;
            //exit();
            $days = DB::table('dentist_calanders')
                ->where('dentist_calanders.service_id', $request->service_id)
                ->where('dentist_calanders.dentist_id', $request->dentist_id)
                ->where('dentist_calanders.end_date', '>', now())
                ->orderBy('end_date', 'DESC')
                ->get();
            $allData = array();
            // var_dump($days);
            foreach ($days as $key => $value) {
                $startTime = strtotime($value->start_date);
                $endTime = date(strtotime($value->end_date));
//$thisDatex="";
                for ($i = $startTime; $i <= $endTime; $i = $i + 86400) {
                    $thisDate = date('l', $i);
//	exit();
                    // $thisDate = date( 'Y-m-d', $i ); // 2010-05-01, 2010-05-02, etc
                    if ($thisDate == $value->day) {
                        //echo $thisDate = date( 'Y-m-d', $i );
                        $thisDatex[] = date('Y-n-j', $i);
                        $day[] = $value->day;
                    }
                }
                //  $thisDatex;
            }
            //echo json_encode($thisDatex);
            return response()->json(['data' => $thisDatex, 'day' => $day]);


        }

    }
