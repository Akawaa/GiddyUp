<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
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

        $vehiculeNB = DB::table('users')
            ->join('vehicule','users.id','=','vehicule.id')
            ->where('users.id',Auth::user()->id)
            ->count();

        return view('dashboard/trip_offers/active',['trajets'=>$trajets,'nbVehicule'=>$vehiculeNB]);
    }

    public function trip_offers_past(){
        return view('dashboard/trip_offers/inactive');
    }


    //Réservation
    public function bookings(){
        $reservations = DB::table('inscrit')->get();

        return view('dashboard/bookings/bookings',['reservations'=>$reservations]);
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

}
