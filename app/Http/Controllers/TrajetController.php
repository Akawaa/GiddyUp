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

        $trajets = Trajet::whereRaw('trajet_date >= curdate()')
                           ->get();

        $depart = DB::table('trajet')
            ->join('etape','etape.trajet_id','=','trajet.trajet_id')
            ->join('ville','etape.ville_insee','=','ville.ville_insee')
            ->where('etape.etape_ordre',1)
            ->get()[0]->ville_nom_reel;

        $nbEtapes = DB::table('trajet')
            ->join('etape','etape.trajet_id','=','trajet.trajet_id')
            ->max('etape.etape_id');

        $arrive = DB::table('trajet')
            ->join('etape','etape.trajet_id','=','trajet.trajet_id')
            ->join('ville','etape.ville_insee','=','ville.ville_insee')
            ->where('etape.etape_ordre',$nbEtapes)
            ->get()[0]->ville_nom_reel;

        $prix = DB::table('trajet')
            ->join('etape','etape.trajet_id','=','trajet.trajet_id')
            ->sum('etape_prix');

        return view('dashboard.trip_offers.active',['trajets'=>$trajets,'nbVehicule'=>$vehiculeNB,'depart'=>$depart,'arrive'=>$arrive,'prix'=>$prix,'nbEtapes'=>$nbEtapes]);
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
