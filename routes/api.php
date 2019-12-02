<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:dapi')->get('/duser', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => 'auth:dapi'], function(){
    //-------------- Messages --------
    Route::get('messages','ApiMessagesController@indexD');  
    Route::get('thread/{id}','ApiMessagesController@show'); 
     Route::put('messages/{id}','ApiMessagesController@update');

});
Route::group(['middleware' => 'auth:api','prefix' => 'clnt'], function(){
    //-------------- Messages --------
    Route::get('messages','ApiMessagesController@indexC'); 
    Route::get('thread/{id}','ApiMessagesController@show');  
   Route::put('messages/{id}','ApiMessagesController@update');

});

Route::get('getThreadId','ApiMessagesController@getThreadId');

Route::namespace('Api')->group(function () {	});



Route::post('/cLogin', 'ApiUserController@Login')->name('clientlogin');
Route::post('/registerClient', 'ApiUserController@registerAction')->name('clientRegister');
Route::get('/userLoginFTime', 'ApiUserController@userLoginFTime')->name('userLoginFTime');
Route::get('/clientDashboard', 'ApiUserController@account')->name('clientDashboard');
Route::get('/deleteDevice', 'ApiUserController@deleteDevice')->name('deleteDevice');
 Route::post('forgetpassword', 'ApiUserController@forgetPassword')->name('ApiForgetPassword');
 Route::post('/Uprofileform','ApiUserController@profileAction')->name('userpostprofile');
 Route::get('/UReservation','ApiEventController@Upcoming_Reserv')->name('UReservation');
 Route::get('/prevReservation','ApiEventController@prev_Reserv')->name('prevReservation'); 
 Route::get('/searchReservation', 'ApiEventController@reservationFormGet')->name('searchReservation');
  Route::get('/Uaccepet/{id}', 'ApiEventController@userAccepet')->name('accepetArr'); 
  Route::get('/UNeglect/{id}', 'ApiEventController@userNeglect')->name('neglectArr'); 
 
 Route::get('/details/{id}', 'ApiEventController@details')->name('deatils'); 
 
Route::post('/registerFClient', 'ApiFollowerController@registerActionFollower')->name('followerRegister');
  Route::get('/getFollower/{id}', 'ApiFollowerController@getFollower')->name('getFollower'); 
 

//Dentist login
Route::get('/Dlogout', 'ApiDentistController@logout')->name('Dlogout');
Route::get('/LoginFirstTime', 'ApiDentistController@LoginFirstTime')->name('LoginFirstTime');
Route::post('/dLogin', 'ApiDentistController@Login')->name('dentistlogin');

Route::post('/registerCreate', 'ApiDentistController@registerAction')->name('dentistRegister');

Route::get('/dentistDashboard', 'ApiDentistController@account')->name('dentistaccount');
Route::get('/deleteDevice', 'ApiDentistController@deleteDevice')->name('deleteDevice');
 Route::post('/Dprofileform','ApiDentistController@profileAction')->name('vendorpostprofile');
 Route::post('/hospitalUpdate','ApiDentistController@hospitalUpdate')->name('hospitalUpdate');
 Route::get('/hospitals','ApiDentistController@hospitals')->name('hospitals');

Route::post('Dforgetpassword', 'ApiDentistController@forgetPassword')->name('DApiForgetPassword');
//Dentist add service

Route::get('showcalander', 'ApiDentist_calanderController@showCalanderForm')->name('showcalnder');
Route::get('showcalander2', 'ApiDentist_calanderController@showCalanderForm2')->name('showcalnder2');
Route::post('add_calander', 'ApiDentist_calanderController@calanderAction')->name('createCalander');
Route::post('updatecalnder', 'ApiDentist_calanderController@calanderAction2')->name('showcalander2');
Route::get('deleteCalander', 'ApiDentist_calanderController@destroy')->name('deleteCalander');
Route::get('selectDate', 'ApiDentist_calanderController@selectDay')->name('selectDay');
Route::get('getServices', 'ApiDentist_calanderController@getServices')->name('getServices');
Route::get('NotificationByDentist', 'ApiNotificationController@NotificationByDentist')->name('NotificationByDentist');
Route::get('NotificationByUser', 'ApiNotificationController@NotificationByUser')->name('NotificationByUser');


//Dentist resrvation
//upcoming accepted reservation for dentist



    Route::get('/dUAReservation','ApiEventController@Upcoming_Reserv_acceptedD')->name('upcommingAcceptedReservation');
	//Next Reservation 
	  Route::get('/dUReservation','ApiEventController@Upcoming_Reserv_D')->name('upcommingReservation');
	// Pending reservation for dentist
    Route::get('/dPReservation','ApiEventController@pending_ReservD')->name('PendingReservation');
	// pervious reservation for dentist
  Route::get('/dprevReservation','ApiEventController@prev_ReservD')->name('prevReservationD');   
  Route::get('/accepet/{id}', 'ApiEventController@accepet')->name('accepetReservation'); 
  Route::get('/Neglect/{id}', 'ApiEventController@neglect')->name('neglectReservation'); 
  Route::get('/approve/{id}', 'ApiEventController@approveArrival')->name('approveArrival'); 
  
  Route::post('/addReservation', 'ApiEventController@store')->name('createReservation'); 
  
  
  //offer
 Route::get('/offers', 'ApiOfferController@index')->name('getOffers'); 
  Route::get('/details', 'ApiOfferController@details')->name('offerDetails');  
  
  
  //services
 Route::get('/services', 'ApiServiceController@index')->name('getservices'); 
  Route::get('/hospitalsByServic', 'ApiServiceController@hospitalByService')->name('gethospitalByservices');  
  Route::get('/hospitals', 'ApiServiceController@hospitals')->name('gethospitals');  
  Route::get('/servicesByCode', 'ApiServiceController@servicesByCode')->name('servicesByCode');  
  Route::get('/searchBycode', 'ApiServiceController@searchBycode')->name('searchBycode');  
 
 