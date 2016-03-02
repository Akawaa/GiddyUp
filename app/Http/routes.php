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

Route::get('/', function () {
    return view('welcome');
});

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
    Route::auth();

    Route::resource('profile/car','VehiculeController',['except' => [
        'show'
    ]]);

    Route::get('/home', 'HomeController@index');

    Route::get('/trip-offers/active', 'HomeController@trip_offers');

    Route::get('/trip-offers/inactive', 'HomeController@trip_offers_past');

    Route::get('/bookings', 'HomeController@bookings');

    Route::get('/bookings/history', 'HomeController@bookings_history');

    Route::get('/ratings', 'HomeController@ratings');

    Route::get('/ratings/received', 'HomeController@ratings_received');

    Route::get('/ratings/given', 'HomeController@ratings_given');

    Route::get('/profile', 'ProfileController@informations');

    Route::post('/profile', 'ProfileController@update_informations');

    Route::get('/profile/university', 'ProfileController@universite');

    Route::get('/profile/picture', 'ProfileController@photo');

    Route::get('/profile/picture', 'ProfileController@preferences');


    Route::get('/profile/password', 'ProfileController@password');

    Route::post('/profile/password', 'HomeController@update_password');

    Route::get('/search','TrajetController@recherche');
});
