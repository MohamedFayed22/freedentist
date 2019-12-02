<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\contactus;
use Validator;
use App\Setting;
class ContactController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   public function contact()
    {
		$sets = array();
        $settings = Setting::all();
        foreach ($settings as $set)
        {
            $sets[$set->setting_name] = $set->setting_value;
        }
      return view('frontend/contact')->with(['sets'=>$sets]);

      
    }

    public function contactform(Request $request)
    {
//      $validator = Validator::make($request->all(), [
//
//       ]);

        $this->validate($request,
            [
                'contact_name' => 'required|string|max:255',
                'contact_mobile'    => 'required|numeric|regex:/(01)[0-9]{9}/',
                'contact_email' => 'required|string|email|max:255',
                'contact_message' => 'required|string',

            ]);

      $contactus = new contactus;
      $contactus->contact_name= $request->contact_name;
      $contactus->contact_mobile= $request->contact_mobile;
      $contactus->contact_email= $request->contact_email;
      $contactus->contact_message= $request->contact_message;
      $contactus->save();

    /*  $message = ($_GET['lang'] == 'en') ? "Your Message has been sent successfully" : "تم إرسال رسالتكم بنجاح";
        Session::flash("message", $message);*/
      return redirect('/');
    }
}
