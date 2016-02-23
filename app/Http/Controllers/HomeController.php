<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

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

    public function trip_offers(){
        return view('dashboard/trip_offers/active');
    }

    public function trip_offers_past(){
        return view('dashboard/trip_offers/inactive');
    }

    public function bookings(){
        return view('dashboard/bookings/bookings');
    }

    public function bookings_history(){
        return view('dashboard/bookings/history');
    }

    public function ratings(){
        return view('dashboard/ratings/hints');
    }

    public function ratings_received(){
        return view('dashboard/ratings/received');
    }

    public function ratings_given(){
        return view('dashboard/ratings/given');
    }

    public function profile(){
        return view('dashboard/profile/profile');
    }
}
