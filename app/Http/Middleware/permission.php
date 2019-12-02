<?php

namespace App\Http\Middleware;

use Closure;

class permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $routeName = $request->route()->getName();
        $user = $request->user();
	
        $routes = array('showuser','adduser','edituser','deleteuser','showcat','addcat','editcat','deletecat',
        'showservice','addservice','editservice','deleteservice','showoffer','addoffer','editoffer','deleteoffer'
        ,'showhospital','addhospital','edithospital','deletehospital');
if( !empty($user->permission) ) {

        foreach ($user->permission as $per) {
          if($per->per_name == $routeName){

              return $next($request);
        }
    }
	}
    return redirect('/access_denied');

}
}
