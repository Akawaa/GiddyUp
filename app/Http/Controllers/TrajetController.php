<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trajet;
use Illuminate\Support\Facades\Auth;
use DB;


use App\Http\Requests;

class TrajetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehiculeNB = DB::table('users')
            ->join('vehicule','users.id','=','vehicule.id')
            ->where('users.id',Auth::user()->id)
            ->count();

        $user = Auth::user()->id;

        $trajets = DB::select('SELECT `v1`.`ville_nom_reel` as depart, `v2`.`ville_nom_reel` as arrivee, t1.*, mod.modele_libelle as modele, mar.marque_libelle as marque
            FROM `etape` `e1`
            INNER JOIN `trajet` `t1` ON `t1`.`trajet_id` = `e1`.`trajet_id`
            INNER JOIN `vehicule` `ve` ON `t1`.`vehicule_id` = `ve`.`vehicule_id`
            INNER JOIN `modele` `mod` ON `mod`.`modele_id` = `ve`.`modele_id`
            INNER JOIN `marque` `mar` ON `mar`.`marque_id` = `mod`.`marque_id`
            INNER JOIN `etape` `e2` ON `t1`.`trajet_id` = `e2`.`trajet_id`
            INNER JOIN `ville` `v2` ON `e2`.`ville_insee` = `v2`.`ville_insee`
            INNER JOIN `ville` `v1` ON `e1`.`ville_insee` = `v1`.`ville_insee`
            WHERE e1.etape_ordre = 1
            AND t1.id = '.$user.'
            AND t1.trajet_date >= curdate()
            AND e2.etape_ordre = (SELECT MAX(etape_ordre) FROM `etape` WHERE `t1`.trajet_id = etape.trajet_id)');

        return view('dashboard.trip_offers.active',['trajets'=>$trajets,'nbVehicule'=>$vehiculeNB]);


    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trajets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
