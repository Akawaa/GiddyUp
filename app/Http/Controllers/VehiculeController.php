<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Vehicule;
use App\Type;
use App\Marque;
use App\Modele;
use App\Couleur;
use Validator;
use DB;
use App\Http\Controllers\Controller;


use App\Http\Requests;

class VehiculeController extends Controller
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
        //$vehicules = Vehicule::all();

        //$vehicules = Vehicule::with(array('modele.marque.type'))->get();

        $vehicules = DB::table('vehicule')
            ->join('modele','vehicule.modele_id','=','modele.modele_id')
            ->join('marque','modele.marque_id','=','marque.marque_id')
            ->join('type','marque.type_id','=','type.type_id')
            ->select('vehicule.*','modele.*','marque.*','type.*')
            ->where('vehicule.id','=',Auth::id())
            ->get();


        return view('dashboard.profile.vehicule.car',['vehicules'=>$vehicules]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $modeles = Modele::all();
        $couleurs = Couleur::all();

        return view('dashboard.profile.vehicule.create_car',['types'=>$types,'modeles'=>$modeles,'couleurs'=>$couleurs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'type' => 'required|numeric',
            'marque' => 'required|numeric',
            'modele' => 'required|numeric',
            'couleur' => 'required|numeric',
            'place' => 'required|numeric',
            'confort' => 'required|numeric'
        ]);

        if($validator->fails()){
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }

        $vehicule = new Vehicule;
        $vehicule->modele_id = $request->modele;
        $vehicule->couleur_id = $request->couleur;
        $vehicule->vehicule_place = $request->place;
        $vehicule->vehicule_confort = $request->confort;
        $vehicule->id = $request->id;

        $vehicule->save();

        return redirect('/profile/car');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $types = Type::all();
        $marques = Marque::all();
        $modeles = Modele::all();
        $couleurs = Couleur::all();

        $vehicule = Vehicule::find($id);

        $idMarque = DB::table('modele')
            ->join('marque','marque.marque_id','=','modele.marque_id')
            ->select('marque.marque_id')
            ->where('modele.modele_id',$vehicule->modele_id)
            ->get()[0]->marque_id;

        $idType = DB::table('marque')
            ->join('type','type.type_id','=','marque.type_id')
            ->select('type.type_id')
            ->where('marque.marque_id',$idMarque)
            ->get()[0]->type_id;


        return view('dashboard.profile.vehicule.edit_car',['types'=>$types,'marques'=>$marques,'marqueCourante'=>$idMarque,'modeles'=>$modeles,'typeCourant'=>$idType,'couleurs'=>$couleurs,'vehicule'=>$vehicule]);
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
        $validator = Validator::make($request->all(),[
            'type' => 'required|numeric',
            'marque' => 'required|numeric',
            'modele' => 'required|numeric',
            'couleur' => 'required|numeric',
            'place' => 'required|numeric',
            'confort' => 'required|numeric'
        ]);

        if($validator->fails()){
            return redirect('/profile/car/'.$id.'/edit')
                ->withInput()
                ->withErrors($validator);
        }

        $vehicule = Vehicule::find($id);
        $vehicule->modele_id = $request->modele;
        $vehicule->couleur_id = $request->couleur;
        $vehicule->vehicule_place = $request->place;
        $vehicule->vehicule_confort = $request->confort;

        $vehicule->save();

        return redirect('/profile/car');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Vehicule::find($id)->delete();

        return redirect('/profile/car')->with('status', 'Le véhicule à bien été supprimé');
    }

    public function get_marque(){

        $sites = DB::table('type')
            ->join('marque','type.type_id','=','marque.type_id')
            ->select('marque.*')
            ->where('type.type_id',$_POST['type'])
            ->get();

        $json=json_encode($sites);
        echo $json;

    }

    public function get_modele(){

        $sites = DB::table('marque')
            ->join('modele','marque.marque_id','=','modele.marque_id')
            ->select('modele.*')
            ->where('marque.marque_id',$_POST['marque'])
            ->get();


        $json=json_encode($sites);
        echo $json;

    }

}