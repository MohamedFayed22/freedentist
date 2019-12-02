<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
    App::setLocale('ar');




/*Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});*/
Route::group(['prefix' => 'messages'], function () {
    Route::get('/','MessagesController@index')->name('messages');
    Route::get('/unread','MessagesController@unread')->name('messages.unread'); // ajax + Pusher
    Route::get('/create',  'MessagesController@create')->name('messages.create');
    Route::post('/', 'MessagesController@store')->name('messages.store');
    Route::get('{id}','MessagesController@show')->name('messages.show');
    Route::put('{id}','MessagesController@update')->name('messages.update');
    Route::get('{id}/read', 'MessagesController@read')->name('messages.read'); // ajax + Pusher
});
Route::group(['prefix' => 'thread', 'as' => 'thread.'], function() {
    Route::get('/{id}/add-participant/{userId}', ['as' => 'add-participant', 'uses' => 'ThreadController@addParticipant']);
    Route::get('/{id}/remove-participant/{userId}', ['as' => 'remove-participant', 'uses' => 'ThreadController@removeParticipant']);
});


Route::get('/', 'frontController@index')->name('index');


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');








Route::get('/login', 'backstage\UserController@login')->name('loginForm');
Route::get('/logout', 'backstage\UserController@logout')->name('logout');
Route::post('/login', 'backstage\UserController@actionLogin')->name('login');


//users and permisssion dashboard
Route::get('/home/users', 'backstage\membersController@index')->name('showuser');
Route::get('/home/users/add', 'backstage\membersController@add')->name('adduser');
Route::get('/home/users/add/{id}', 'backstage\membersController@add')->name('edituser');
Route::post('/home/users/store', 'backstage\membersController@store')->name('storeuser');
Route::post('/home/users/permission', 'backstage\membersController@permission')->name('permission');
Route::put('/home/users/update/{id}', 'backstage\membersController@update')->name('updateuser');
Route::delete('/home/users/delete/{id}', 'backstage\membersController@destroy')->name('deleteuser');


//Hospital
Route::get('/home/hospitals', 'backstage\HospitalController@index')->name('showhospital');
Route::get('/home/hospitals/add', 'backstage\HospitalController@add')->name('addhospital');
Route::get('/home/hospitals/add/{id}', 'backstage\HospitalController@add')->name('edithospital');
Route::post('/home/hospitals/store', 'backstage\HospitalController@store')->name('storehospital');
Route::put('/home/hospitals/update/{id}', 'backstage\HospitalController@update')->name('updatehospital');
Route::delete('/home/hospitals/delete/{id}', 'backstage\HospitalController@destroy')->name('deletehospital');


//Services
Route::get('/home/services', 'backstage\ServiceController@index')->name('showservice');
Route::get('/home/services/add', 'backstage\ServiceController@add')->name('addservice');
Route::get('/home/services/add/{id}', 'backstage\ServiceController@add')->name('editservice');
Route::post('/home/services/store', 'backstage\ServiceController@store')->name('storeservice');
Route::put('/home/services/update/{id}', 'backstage\ServiceController@update')->name('updateservice');
Route::delete('/home/services/delete/{id}', 'backstage\ServiceController@destroy')->name('deleteservice');

//Offers
Route::get('/home/offers', 'backstage\OfferController@index')->name('showoffer');
Route::get('/home/offers/add', 'backstage\OfferController@add')->name('addoffer');
Route::get('/home/offers/add/{id}', 'backstage\OfferController@add')->name('editoffer');
Route::post('/home/offers/store', 'backstage\OfferController@store')->name('storeoffer');
Route::put('/home/offers/update/{id}', 'backstage\OfferController@update')->name('updateoffer');
Route::delete('/home/offers/delete/{id}', 'backstage\OfferController@destroy')->name('deleteoffer');


//Dentists
Route::get('/home/dentists', 'backstage\DentistController@index')->name('showdentist');
Route::get('dentistSerach', 'backstage\DentistController@search')->name('dentistSerach');
Route::get('/home/dentists/add', 'backstage\DentistController@add')->name('adddentist');
Route::get('/home/dentists/add/{id}', 'backstage\DentistController@add')->name('editdentist');
Route::post('/home/dentists/store', 'backstage\DentistController@store')->name('storedentist');
Route::put('/home/dentists/update/{id}', 'backstage\DentistController@update')->name('updatedentist');
Route::delete('/home/dentists/delete/{id}', 'backstage\DentistController@destroy')->name('deletedentist');
Route::get('/home/dentists/dentist-calender', 'backstage\DentistCalanderController@index')->name('dentist-calender');



//sicks
Route::get('/home/saudi-sicks', 'backstage\StaticsController@indexSaudi')->name('indexSaudi');

Route::get('/home/sicks', 'backstage\SickController@index')->name('showsick');
Route::get('sickSerach', 'backstage\SickController@search')->name('sickSerach');
Route::get('/home/sicks/add', 'backstage\SickController@add')->name('addsick');
Route::get('/home/sicks/add/{id}', 'backstage\SickController@add')->name('editsick');
Route::post('/home/sicks/store', 'backstage\SickController@store')->name('storesick');
Route::put('/home/sicks/update/{id}', 'backstage\SickController@update')->name('updatesick');
Route::delete('/home/sicks/delete/{id}', 'backstage\SickController@destroy')->name('deletesick');

//Orders
Route::get('/home/orders', 'backstage\OrderController@index')->name('showorder');
Route::get('/home/orders/prev_Reserv', 'backstage\OrderController@prev_Reserv')->name('showPorder');
Route::get('/home/orders/Upcoming_Reserv_acceptedD', 'backstage\OrderController@Upcoming_Reserv_acceptedD')->name('showUorder');
Route::get('/home/orders/Showdetails/{id}', 'backstage\OrderController@details')->name('Showdetails');




//Frontend

//Language
Route::post('/language-chooser','LanguageController@changeLanguage');
	Route::post('/language/',array(
	'before'=>'csrf',
	'as'=>'language-chooser',
	'uses'=>'LanguageController@changeLanguage',
	));

// Dentist register
Route::get('/Dlogout', 'DentistController@logout')->name('Dlogout');
Route::get('/dLogin', 'DentistController@showLoginForm')->name('dentistLoginForm');
Route::post('/dLogin', 'DentistController@Login')->name('dentistlogin');
Route::get('/registerCreate', 'DentistController@showRegisterForm')->name('create');
Route::post('/registerCreate', 'DentistController@registerAction')->name('dentistRegister');

Route::get('/ActiveLoginD', 'DentistController@ActiveLoginformD')->name('ActiveLoginD');
Route::post('/ActiveActionD', 'DentistController@userLoginFTimeD')->name('ActiveActionD');

Route::get('dForgetPassword1', 'DentistController@forgetPassword')->name('dForgetPassword');
Route::post('dForgetPassword', 'DentistController@forgetPasswordAction')->name('dForgetPasswordAction');

//Dentist add service
Route::get('add_calander', 'Dentist_calanderController@showCalanderForm')->name('showCalanderForm');
Route::post('add_calander', 'Dentist_calanderController@calanderAction')->name('createCalander');
Route::get('calander/{id}', 'Dentist_calanderController@calander')->name('editcalander');
Route::post('updatecalander/{id}', 'Dentist_calanderController@UpdateCalander')->name('updateCalander');
Route::get('deletecalander/{id}', 'Dentist_calanderController@destroy')->name('deleteCalander');

//Dentist resrvation
//upcoming accepted reservation for dentist
    Route::get('/dUAReservation','EventController@Upcoming_Reserv_acceptedD')->name('upcommingAcceptedReservation');
	//Next Reservation 
	  Route::get('/dUReservation','EventController@Upcoming_Reserv_D')->name('upcommingReservation');
	// Pending reservation for dentist
    Route::get('/dPReservation','EventController@pending_ReservD')->name('PendingReservation');
	// pervious reservation for dentist
  Route::get('/dprevReservation','EventController@prev_ReservD')->name('prevReservationD');   
  Route::get('/accepet/{id}', 'EventController@accepet')->name('accepetReservation'); 
  Route::get('/Neglect/{id}', 'EventController@neglect')->name('neglectReservation'); 
  Route::get('/approve/{id}', 'EventController@approveArrival')->name('approveArrival'); 

  
// Dentist Dashboard
Route::get('/dentistDashboard', 'DentistController@account')->name('dentistDashboard');
Route::get('/Dprofile','DentistController@profile')->name('vendorProfile');
    Route::post('/Dprofileform','DentistController@profileAction')->name('vendorpostprofile');
Route::get('/Ddetails/{id}', 'EventController@detailsD')->name('Ddeatils'); 





// Client register
Route::get('/Clogout', 'UserController@logout')->name('Clogout');
Route::get('/cLogin', 'UserController@showLoginForm')->name('clientLoginForm');
Route::post('/cLogin', 'UserController@Login')->name('clientlogin');
Route::get('/registerClient', 'UserController@showRegisterForm')->name('createClient');
Route::post('/registerClient', 'UserController@registerAction')->name('clientRegister');
/*Route::group(['middleware' => ['web']], function () {
	Route::get('/registerClient', 'UserController@showRegisterForm')->name('createClient');
    Route::post('/registerClient', 'UserController@registerAction')->name('clientRegister');
});*/
/*Route::get('/', function () {
    //..
})->middleware('web')*/;
// Client Dashboard
Route::get('/clientDashboard', 'UserController@account')->name('clientDashboard');
Route::get('/ActiveLogin', 'UserController@ActiveLoginform')->name('ActiveLogin');
Route::post('/ActiveAction', 'UserController@userLoginFTime')->name('ActiveAction');
Route::get('uForgetPassword1', 'UserController@forgetPasswordU')->name('uForgetPassword');
Route::post('ForgetPasswordU', 'UserController@forgetPasswordActionU')->name('ForgetPasswordActionU');
//client Profile
    Route::get('/profile','UserController@profile')->name('profile');
    Route::post('/profileform','UserController@profileAction')->name('postprofile');

// Client calnder 
//client Get reservation
    Route::get('/UReservation','EventController@Upcoming_Reserv')->name('UReservation');
      Route::get('/UAReservation','EventController@Upcoming_AReserv')->name('UAReservation');
  Route::get('/prevReservation','EventController@prev_Reserv')->name('prevReservation'); 
    
 //Client make reservation 
Route::get('/reservation', 'EventController@reservationForm')->name('reservationForm');
Route::get('/searchReservation', 'EventController@reservationFormGet')->name('searchReservation'); 
Route::get('/search/start/{start}/end/{end}/hospital/{hospital}/service/{service}/date/{date}/dentist/{dentist}', 'EventController@search')->name('SearchTime'); 
Route::get('/NotValid', 'EventController@notValid')->name('notvalidReser');
Route::post('/addReservation', 'EventController@store')->name('createReservation'); 
Route::get('/details/{id}', 'EventController@details')->name('deatils'); 
   Route::get('/Uaccepet/{id}', 'EventController@userAccepet')->name('accepetArr'); 
  Route::get('/UNeglect/{id}', 'EventController@userNeglect')->name('neglectArr'); 
  
// client add/edit/delete/list follower

Route::get('/followers', 'FollowerController@index')->name('followers');
Route::get('/editFollower/{id}', 'FollowerController@add')->name('editFollowers');

Route::post('/updateFClient/{id}', 'FollowerController@update')->name('updateFollower');
Route::delete('/deleteFollower/{id}', 'FollowerController@destroy')->name('deleteFollower');
Route::get('/registerFClient', 'FollowerController@showRegisterFollower')->name('createFollower');
Route::post('/registerFClient', 'FollowerController@registerActionFollower')->name('followerRegister');


//Ajax
Route::post('/select-ajax2', 'AjaxController@selectDentist')->name('select-ajax2');
Route::post('/select-hospital', 'AjaxController@selectHospital')->name('select-hospital');
Route::post('/select-city', 'AjaxController@selectCity')->name('select-city');
Route::post('/select-day', 'AjaxController@selectDay')->name('select-day');
Route::post('/select-date', 'AjaxController@selectDate')->name('select-date');

// frontend pages
//contact us
  Route::get('/contact','ContactController@contact')->name('contact');
  Route::post('/contactform','ContactController@contactform')->name('postcontact');
//about us
    Route::get('/about','frontController@aboutUs')->name('aboutus');
     Route::get('/Privacy-Policy','frontController@Privacy')->name('PrivacyPolicy');
       Route::get('/terms','frontController@terms')->name('terms');
    Route::post('/getNotification','NotificationController@getNotification')->name('getNotification');
    Route::get('/NotificationArrive','NotificationController@NotificationForUserTOArrive')->name('NotificationArrive');

