<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Offer;

use DB;
use Auth;
use Session;
class ApiOfferController extends Controller
{
   
		
		 public function index()
        {
            $objects = Offer::get();
           return response()->json(['status'=>'successe','data'=>$objects]);
       

        }
		public function details(Request $request){
			$id=$request->input('offer_id');
            if($id)
            {
                $object=Offer::find($id);
				$photo = explode (",", $object->photo);  
				$title_ar = $object->title_ar;  
				$title_en = $object->title_en;  
				$description_ar = $object->description_ar;  
				$description_en = $object->description_en;  
				$date = $object->date;  
				$link = $object->link;  
				$phone = $object->phone;  
				
           return response()->json(['photo'=>$photo,'title_ar'=>$title_ar,'title_en'=>$title_en,'description_ar'=>$description_ar,'description_en'=>$description_en,'date'=>$date,'link'=>$link,'phone'=>$phone,'status'=>'success']);
            }
       
        }
		

}
