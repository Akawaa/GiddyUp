<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trajet;
use App\Etape;
use App\Question;
use App\Reponse;
use App\Inscrit;
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
        $trajet = Trajet::find($id);

        $etapes = Etape::where('trajet_id',$id)
                ->orderBy('etape_ordre','asc')
                ->get();

        $nbTrajets = Trajet::where('id',$trajet->id)
                ->count();

        $depart = DB::table('etape')
            ->join('ville','ville.ville_insee','=','etape.ville_insee')
            ->where('etape.trajet_id',$id)
            ->where('etape.etape_ordre',1)
            ->get()[0];


        $nbEtapes = Etape::where('trajet_id',$id)
                ->max('etape_ordre');

        $arrivee = DB::table('etape')
            ->join('ville','ville.ville_insee','=','etape.ville_insee')
            ->where('etape.trajet_id',$id)
            ->where('etape.etape_ordre',$nbEtapes)
            ->get()[0];

        $inscrit = Inscrit::where('trajet_id',$id)
                ->count();

        $places = $trajet->trajet_place - $inscrit;

        $questions = Question::where('trajet_id',$id)
            ->get();

        $reponses = Reponse::join('question','question.question_id','=','reponse.question_id')
                ->where('question.trajet_id',$id)
                ->select('reponse.id','reponse.reponse_libelle','reponse.created_at','reponse.question_id','reponse.reponse_id')
                ->get();

        $avis = DB::table('trajet')
            ->join('inscrit','trajet.trajet_id','=','inscrit.trajet_id')
            ->where('trajet.trajet_id',$id)
            ->take(3)
            ->get();

        $exp = DB::table('inscrit')
            ->join('trajet','trajet.trajet_id','=','inscrit.trajet_id')
            ->where('trajet.id',Auth::user()->id)
            ->where('trajet.trajet_date','<','curdate()')
            ->count('inscrit.id');

        $avisConducteur = DB::table('inscrit')
            ->join('trajet','trajet.trajet_id','=','inscrit.trajet_id')
            ->join('users','users.id','=','inscrit.id')
            ->where('trajet.id',$trajet->id)
            ->take(3)
            ->orderBy('inscrit.inscription_date_commentaire_conducteur','desc')
            ->get();

        $noteConducteur = DB::table('inscrit')
            ->join('trajet','trajet.trajet_id','=','inscrit.trajet_id')
            ->where('trajet.id',$trajet->id)
            ->avg('inscrit.inscription_avis_conducteur');

        $notePassager = DB::table('inscrit')
            ->join('trajet','trajet.trajet_id','=','inscrit.trajet_id')
            ->where('inscrit.id',$trajet->id)
            ->avg('inscrit.inscription_avis_voyageur');

        return view('trajets.show',['trajet'=>$trajet,
            'depart'=>$depart,
            'arrivee'=>$arrivee,
            'avis'=>$avis,
            'nbTrajets'=>$nbTrajets,
            'etapes'=>$etapes,
            'nbEtapes'=>$nbEtapes,
            'questions'=>$questions,
            'reponses'=>$reponses,
            'places'=>$places,
            'exp'=>$exp,
            'avis'=>$avisConducteur,
            'noteConducteur'=>$noteConducteur,
            'notePassager'=>$notePassager]);
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
