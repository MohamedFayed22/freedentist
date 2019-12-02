<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Session;
use App;
use Config;
class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
	//	echo 'h';
     if (Session::has('locale')){
	 	$locale=Session::get('locale',config::get('app.locale'));
		
		}else{
			$locale='ar';
		}
		   App::setLocale($locale);
         return $next($request);
     }
     

       
}
