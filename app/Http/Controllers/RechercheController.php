<?php

namespace App\Http\Controllers;

use App\Trajet;
use Illuminate\Http\Request;
use App\Ville;
use App\Etape;
use App\Question;
use App\Reponse;
use App\Inscrit;
use Auth;
use DB;
use Validator;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;

class RechercheController extends Controller
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
        return view('search.search');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'depart' => 'required',
            'arrivee' => 'required',
            'date' => 'required',
        ]);

        if($validator->fails()){
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }


        $villeDep = explode(' - ',$request->depart);

        session()->put('depart',$villeDep);



        $depart = Ville::where('departementVille',$villeDep[1])
                ->where('ville_nom_reel',$villeDep[0])
                ->get()[0];

        $villeArr = explode(' - ',$request->arrivee);

        session()->put('arrivee',$villeArr);


        $arrivee = Ville::where('departementVille',$villeArr[1])
            ->where('ville_nom_reel',$villeArr[0])
            ->get()[0];

        $date = date('Y-m-d',strtotime($request->date));

        $date = strtotime('-1 day',strtotime($date));
        $date = date('Y-m-d',$date);


        $recherche = DB::select("SELECT trajet.*,users.name, users.*, vehicule.vehicule_confort, modele.modele_libelle, marque.marque_libelle, v1.ville_nom_reel as depart, v2.ville_nom_reel as arrivee
                            FROM users
                            INNER JOIN trajet ON users.id = trajet.id
                            INNER JOIN vehicule ON trajet.vehicule_id = vehicule.vehicule_id
                            INNER JOIN modele ON vehicule.modele_id = modele.modele_id
                            INNER JOIN marque ON modele.marque_id = marque.marque_id
                            INNER JOIN etape e1 ON trajet.trajet_id = e1.trajet_id
                            INNER JOIN etape e2 ON trajet.trajet_id = e2.trajet_id
                            INNER JOIN ville v2 ON e2.ville_insee = v2.ville_insee
                            INNER JOIN ville v1 ON e1.ville_insee = v1.ville_insee
                            AND e2.etape_ordre = (SELECT MAX(etape_ordre) FROM etape WHERE trajet.trajet_id = etape.trajet_id)
                            WHERE e1.etape_ordre = 1
                            AND trajet.trajet_id
                            IN (
                                SELECT trajet.trajet_id
                                FROM ville
                                INNER JOIN etape e1 ON ville.ville_insee = e1.ville_insee
                                INNER JOIN trajet ON e1.trajet_id = trajet.trajet_id
                                WHERE trajet.trajet_date <= '".$date."'
                                AND ville.ville_nom IN (
                                    SELECT ville.ville_nom
                                    FROM `ville`
                                    INNER JOIN etape ON ville.ville_insee = etape.ville_insee
                                    INNER JOIN trajet ON etape.trajet_id = trajet.trajet_id
                                    WHERE trajet.trajet_date = '".$date."'
                                    AND (((acos(sin((".$depart->ville_lat."*pi()/180)) * sin((ville_lat*pi()/180)) + cos((".$depart->ville_lat."*pi()/180)) * cos((ville_lat*pi()/180)) * cos(((".$depart->ville_long." - ville_long)*pi()/180))))*180/pi())*60*2.133) <= trajet.trajet_detour
                                )
                                AND trajet.trajet_id IN (
                                    SELECT trajet.trajet_id
                                    FROM ville
                                    INNER JOIN etape ON ville.ville_insee = etape.ville_insee
                                    INNER JOIN trajet ON etape.trajet_id = trajet.trajet_id
                                    WHERE trajet.trajet_date = '".$date."'
                                    AND ville.ville_nom IN (
                                        SELECT ville.ville_nom
                                        FROM ville
                                        INNER JOIN etape ON ville.ville_insee = etape.ville_insee
                                        INNER JOIN trajet ON etape.trajet_id = trajet.trajet_id
                                        WHERE trajet.trajet_date = '".$date."'
                                        AND (((acos(sin((".$arrivee->ville_lat."*pi()/180)) * sin((ville_lat*pi()/180)) + cos((".$arrivee->ville_lat."*pi()/180)) * cos((ville_lat*pi()/180)) * cos(((".$arrivee->ville_long." - ville_long)*pi()/180))))*180/pi())*60*2.133) <= trajet.trajet_detour
                                        AND (
                                            etape.etape_ordre > e1.etape_ordre
                                        )
                                    )
                                )
                            )
                            ORDER BY trajet.trajet_heure asc

                    ");

        if(count($recherche) > 0) {
            $idsTrajets = [];
            foreach ($recherche as $trajet) {
                array_push($idsTrajets, $trajet->trajet_id);
            }
            array_walk($idsTrajets, 'intval');
            $ids = implode(',', $idsTrajets);
            $etapes = DB::select("SELECT etape.*, ville.*
                            FROM etape
                            INNER JOIN ville ON ville.ville_insee = etape.ville_insee
                            WHERE etape.trajet_id
                            IN ($ids)
                            ORDER BY etape.trajet_id, etape.etape_ordre");

            $prix = [];
            $places = [];
            $session_etape = [];


            foreach($idsTrajets as $id) {
                $sess = DB::select("SELECT v1.ville_insee AS insee_depart, v2.ville_insee AS insee_arrivee, v1.ville_nom_reel as ville_depart, v2.ville_nom_reel as ville_arrivee, $id as trajet_id
                            FROM ville v1 INNER JOIN etape e1 ON e1.ville_insee = v1.ville_insee
                            INNER JOIN trajet ON e1.trajet_id = trajet.trajet_id
                            INNER JOIN etape e2 ON e2.trajet_id = trajet.trajet_id
                            INNER JOIN ville v2 ON e2.ville_insee = v2.ville_insee
                            WHERE trajet.trajet_id = $id
                            AND (((acos(sin((" . $depart->ville_lat . "*pi()/180)) * sin((v1.ville_lat*pi()/180)) + cos((" . $depart->ville_lat . "*pi()/180)) * cos((v1.ville_lat*pi()/180)) * cos(((" . $depart->ville_long . " - v1.ville_long)*pi()/180))))*180/pi())*60*2.133) <= trajet.trajet_detour
                            AND (((acos(sin((" . $arrivee->ville_lat . "*pi()/180)) * sin((v2.ville_lat*pi()/180)) + cos((" . $arrivee->ville_lat . "*pi()/180)) * cos((v2.ville_lat*pi()/180)) * cos(((" . $arrivee->ville_long . " - v2.ville_long)*pi()/180))))*180/pi())*60*2.133) <= trajet.trajet_detour
                            ");

                array_push($session_etape, $sess);
            }
            session()->put('villes',$session_etape);


            foreach($idsTrajets as $id){
                $tmp = DB::select("SELECT SUM(etape.etape_prix) as prix, etape.trajet_id FROM etape
                        WHERE etape.trajet_id = $id
                          AND etape.etape_ordre BETWEEN
                          (
                              SELECT e1.etape_ordre
                              FROM ville v1
                              INNER JOIN etape e1 ON e1.ville_insee = v1.ville_insee
                              INNER JOIN trajet ON e1.trajet_id = trajet.trajet_id
                              WHERE trajet.trajet_id = $id
                              AND (((acos(sin((" . $depart->ville_lat . "*pi()/180)) * sin((v1.ville_lat*pi()/180)) + cos((" . $depart->ville_lat . "*pi()/180)) * cos((v1.ville_lat*pi()/180)) * cos(((" . $depart->ville_long . " - v1.ville_long)*pi()/180))))*180/pi())*60*2.133) <= trajet.trajet_detour)
                           AND
                            (
                            SELECT e2.etape_ordre
                            FROM ville v2
                            INNER JOIN etape e2 ON e2.ville_insee = v2.ville_insee
                                        INNER JOIN trajet ON e2.trajet_id = trajet.trajet_id
                                        WHERE trajet.trajet_id = $id
                                        AND (((acos(sin((" . $arrivee->ville_lat . "*pi()/180)) * sin((v2.ville_lat*pi()/180)) + cos((" . $arrivee->ville_lat . "*pi()/180)) * cos((v2.ville_lat*pi()/180)) * cos(((" . $arrivee->ville_long . " - v2.ville_long)*pi()/180))))*180/pi())*60*2.133) <= trajet.trajet_detour)
                                        ");


                $etapeDepart = DB::select("SELECT e1.etape_ordre
                              FROM ville v1
                              INNER JOIN etape e1 ON e1.ville_insee = v1.ville_insee
                              INNER JOIN trajet ON e1.trajet_id = trajet.trajet_id
                              WHERE trajet.trajet_id = $id
                              AND (((acos(sin((" . $depart->ville_lat . "*pi()/180)) * sin((v1.ville_lat*pi()/180)) + cos((" . $depart->ville_lat . "*pi()/180)) * cos((v1.ville_lat*pi()/180)) * cos(((" . $depart->ville_long . " - v1.ville_long)*pi()/180))))*180/pi())*60*2.133) <= trajet.trajet_detour
                          ");


                $etapeArrivee = DB::select("SELECT e2.etape_ordre
                            FROM ville v2
                            INNER JOIN etape e2 ON e2.ville_insee = v2.ville_insee
                                        INNER JOIN trajet ON e2.trajet_id = trajet.trajet_id
                                        WHERE trajet.trajet_id = $id
                                        AND (((acos(sin((" . $arrivee->ville_lat . "*pi()/180)) * sin((v2.ville_lat*pi()/180)) + cos((" . $arrivee->ville_lat . "*pi()/180)) * cos((v2.ville_lat*pi()/180)) * cos(((" . $arrivee->ville_long . " - v2.ville_long)*pi()/180))))*180/pi())*60*2.133) <= trajet.trajet_detour
                                        ");


                $tmpPlace = DB::select("SELECT count(DISTINCT inscrit.id) as nbPlace, $id as trajet_id
                        FROM inscrit
                        INNER JOIN trajet ON inscrit.trajet_id = trajet.trajet_id
                        INNER JOIN etape ON etape.trajet_id = trajet.trajet_id
                        WHERE trajet.trajet_id = $id
                        AND (
                            inscrit.ville_insee_depart IN (
                                SELECT etape.ville_insee
                                FROM etape
                                WHERE etape.trajet_id = $id
                                AND etape.etape_ordre <= ".$etapeDepart[0]->etape_ordre."
                            )
                            AND
                            inscrit.ville_insee_arrivee IN (
                                SELECT etape.ville_insee
                                FROM etape
                                WHERE etape.trajet_id = $id
                                AND etape.etape_ordre > ".$etapeDepart[0]->etape_ordre."
                            )
                        ) OR (
                            inscrit.ville_insee_depart IN (
                                SELECT etape.ville_insee
                                FROM etape
                                WHERE etape.trajet_id = $id
                                AND etape.etape_ordre > ".$etapeDepart[0]->etape_ordre."
                            )
                            AND
                            inscrit.ville_insee_depart IN (
                                SELECT etape.ville_insee
                                FROM etape
                                WHERE etape.trajet_id = $id
                                AND etape.etape_ordre <= ".$etapeArrivee[0]->etape_ordre."
                            )
                        )

                        ");

                array_push($prix, $tmp);
                array_push($places,$tmpPlace);
            }

            session()->put('prix',$prix);
            session()->put('places',$places);

            $arr = [];
            $prix_etapes = [];

            foreach($prix as $prix){
                $arr['item'] = ['prix'=>$prix[0]->prix,'trajet_id'=>$prix[0]->trajet_id];

                array_push($prix_etapes,$arr);
            }

            $pl = [];
            $places_occ = [];

            foreach($places as $place){
                $pl['item'] = ['nbPlace'=>$place[0]->nbPlace,'trajet_id'=>$place[0]->trajet_id];

                array_push($places_occ,$pl);
            }


            return view('search.show',['recherche'=>$recherche,'etapes'=>$etapes,'depart'=>$depart,'arrivee'=>$arrivee,'prix'=>$prix_etapes,'places'=>$places_occ]);


        }

        return view('search.show',['recherche'=>$recherche,'depart'=>$depart,'arrivee'=>$arrivee]);

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

        $questions = Question::where('trajet_id',$id)
            ->get();

        $reponses = Reponse::join('question','question.question_id','=','reponse.question_id')
            ->where('question.trajet_id',$id)
            ->select('reponse.id','reponse.reponse_libelle','reponse.created_at','reponse.question_id','reponse.reponse_id')
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
            ->where('inscrit.inscription_commentaire_conducteur','!=','')
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

        $etapes = Etape::where('trajet_id',$id)
            ->orderBy('etape_ordre','asc')
            ->get();

        $nbEtapes = Etape::where('trajet_id',$id)
            ->max('etape_ordre');

        $inscrit = Inscrit::where('trajet_id',$id)
            ->count();

        $places = $trajet->trajet_place - $inscrit;

        $nbTrajets = Trajet::where('id',$trajet->id)
            ->count();

        $depart = DB::table('etape')
            ->join('ville','ville.ville_insee','=','etape.ville_insee')
            ->where('etape.trajet_id',$id)
            ->where('etape.etape_ordre',1)
            ->get()[0];


        $arrivee = DB::table('etape')
            ->join('ville','ville.ville_insee','=','etape.ville_insee')
            ->where('etape.trajet_id',$id)
            ->where('etape.etape_ordre',$nbEtapes)
            ->get()[0];

        return view('search.show_one',['depart'=>$depart,
                                        'arrivee'=>$arrivee,
                                        'trajet'=>$trajet,
                                        'etapes'=>$etapes,
                                        'nbEtapes'=>$nbEtapes,
                                        'places'=>$places,
                                        'nbTrajets'=>$nbTrajets,
                                        'questions'=>$questions,
                                        'reponses'=>$reponses,
                                        'exp'=>$exp,
                                        'avis'=>$avisConducteur,
                                        'noteConducteur'=>$noteConducteur,
                                        'notePassager'=>$notePassager]);
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

    public function get_villes(){
        $villes = Ville::where('ville_nom_reel','LIKE',$_POST["ville"].'%')
            ->take(10)
            ->orderBy('ville_nom_reel','asc')
            ->get();


        $json=json_encode($villes);
        echo $json;

    }
}
