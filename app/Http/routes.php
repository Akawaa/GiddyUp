<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


Route::group(['middleware' => 'web'], function () {
    Route::get('/','WelcomeController@index');

    Route::auth();

    Route::get('/home', 'HomeController@index');

    Route::resource('profile','InformationController',['only' => ['edit','update']]);

    Route::get('profile/show/{id}','InformationController@show');

    Route::resource('profile/university','UniversiteController',['only' => ['edit','update','destroy']]);

    Route::post('profile/university/{id}/getSite','UniversiteController@get_site');

    Route::resource('profile/preferences','PreferenceController',['only' => ['edit','update']]);

    Route::resource('profile/picture','PhotoController',['only' => ['edit','update','destroy']]);

    Route::resource('profile/car','VehiculeController',['except' => [
        'show'
    ]]);

    Route::post('profile/car/getMarque','VehiculeController@get_marque');

    Route::post('profile/car/getModele','VehiculeController@get_modele');

    Route::post('profile/car/{id}/getMarque','VehiculeController@get_marque');

    Route::post('profile/car/{id}/getModele','VehiculeController@get_modele');

    Route::resource('profile/car/picture','PhotoVehiculeController',['only' => ['edit','update','destroy']]);

    Route::resource('profile/email','ChangeEmailController',['only' => ['edit','update']]);

    Route::resource('profile/password','ChangePasswordController',['only' => ['edit','update']]);

    Route::resource('trip-offers','TrajetController');

    Route::resource('trip-offers-inactive', 'TrajetPastController@index');

    Route::resource('question','QuestionController',['only'=>['store','destroy']]);

    Route::resource('reponse','ReponseController',['only'=>['store','destroy']]);

    Route::resource('/search','RechercheController',['only'=>['index','store','show']]);

    Route::resource('/sign','InscritController',['only'=>['store']]);

    Route::post('/getVilles','RechercheController@get_villes');

    Route::resource('/bookings', 'BookingController',['only'=>['index','show']]);

    Route::resource('/bookings-history', 'BookingHistoryController',['only'=>['index','show']]);

    Route::resource('/create-trip', 'AjoutController',['only'=>['store']]);

    Route::resource('ratings', 'RatingController',['only'=>['index','store']]);

    Route::resource('/ratings-received', 'RatingReceivedController',['only'=>['index']]);

    Route::resource('/ratings-given', 'RatingGivenController',['only'=>['index']]);




    Route::get('/team','AboutController@team');

    Route::get('/about','AboutController@comment');

    Route::get('/application','AboutController@application');




    Route::get('/ratings/given', 'HomeController@ratings_given');

});
