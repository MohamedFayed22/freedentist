<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Session;
use App;
use lang;
class LanguageController extends Controller
{
    

    public function changeLanguage(Request $request)
    {
		
		if ($request->ajax()) {
			$request->session()->put('locale',$request->locale);

			}
       

    }
}
