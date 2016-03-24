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
        $user = Auth::user()->id;

        $questions = DB::select('SELECT `v1`.`ville_nom_reel` as depart, `v2`.`ville_nom_reel` as arrivee, `q`.*, `u1`.*
            FROM `question` `q`
            INNER JOIN `trajet` `t1` ON `q`.`trajet_id` = `t1`.`trajet_id`
            INNER JOIN `users` `u1` on `u1`.`id` = `t1`.`id`
            INNER JOIN `etape` `e1` ON `t1`.`trajet_id` = `e1`.`trajet_id`
            INNER JOIN `etape` `e2` ON `t1`.`trajet_id` = `e2`.`trajet_id`
            INNER JOIN `ville` `v2` ON `e2`.`ville_insee` = `v2`.`ville_insee`
            INNER JOIN `ville` `v1` ON `e1`.`ville_insee` = `v1`.`ville_insee`
            WHERE e1.etape_ordre = 1
            AND t1.trajet_date >= curdate()
            AND e2.etape_ordre = (SELECT MAX(etape_ordre) FROM `etape` WHERE `t1`.trajet_id = etape.trajet_id)
            AND trajet_date >= curdate()
            AND `u1`.id = '.$user.'
            AND `q`.`question_id` NOT IN (SELECT reponse.question_id FROM reponse )');

        $exp = DB::table('inscrit')
            ->join('trajet','trajet.trajet_id','=','inscrit.trajet_id')
            ->where('trajet.id',$user)
            ->where('trajet.trajet_date','<',DB::raw('curdate()'))
            ->count();

        return view('dashboard.home',['questions'=>$questions,'exp'=>$exp]);
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
