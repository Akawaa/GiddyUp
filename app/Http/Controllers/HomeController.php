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
        return view('dashboard/trip_offers');
    }

    public function bookings(){
        return view('dashboard/bookings');
    }

    public function ratings(){
        return view('dashboard/ratings');
    }

    public function profile(){
        return view('dashboard/profile');
    }
}
