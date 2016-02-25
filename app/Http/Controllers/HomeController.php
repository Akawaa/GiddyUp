<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard/home');
    }


    //Annonce
    public function trip_offers(){

        $trajets = DB::table('trajet')->get();

        return view('dashboard/trip_offers/active',['trajets'=>$trajets]);
    }

    public function trip_offers_past(){
        return view('dashboard/trip_offers/inactive');
    }


    //Réservation
    public function bookings(){
        return view('dashboard/bookings/bookings');
    }

    public function bookings_history(){
        return view('dashboard/bookings/history');
    }

    //Avis
    public function ratings(){
        return view('dashboard/ratings/hints');
    }

    public function ratings_received(){
        return view('dashboard/ratings/received');
    }

    public function ratings_given(){
        return view('dashboard/ratings/given');
    }

    //Profil
    public function profile(){
        return view('dashboard/profile/profile');
    }

    public function profile_universite(){

        $universites = DB::table('universite')->get();

        $sites = DB::table('site')
            ->join('universite', 'universite.universite_id', '=', 'site.universite_id')
            ->select('site.*')
            ->get();


        return view('dashboard/profile/universite',['universites'=>$universites,'sites'=>$sites]);
    }

}
