<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

class BookingHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inscrit = DB::table('inscrit')
            ->join('trajet','trajet.trajet_id','=','inscrit.trajet_id')
            ->join('users','trajet.id','=','users.id')
            ->join('vehicule','trajet.vehicule_id','=','vehicule.vehicule_id')
            ->join('modele','vehicule.modele_id','=','modele.modele_id')
            ->join('marque','modele.marque_id','=','marque.marque_id')
            ->where('inscrit.id',Auth::user()->id)
            ->where('trajet.trajet_date','<=',DB::raw('curdate()'))
            ->get();



        if(count($inscrit) > 0) {
            $idsTrajets = [];
            foreach ($inscrit as $trajet) {
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


            foreach($idsTrajets as $id) {

                $tmpPrix = DB::select("SELECT SUM(etape.etape_prix) as prix, etape.trajet_id FROM etape
                        WHERE etape.trajet_id = $id
                          AND etape.etape_ordre BETWEEN
                          (
                              SELECT e1.etape_ordre
                              FROM ville v1
                              INNER JOIN etape e1 ON e1.ville_insee = v1.ville_insee
                              INNER JOIN trajet ON trajet.trajet_id = e1.trajet_id
                              INNER JOIN inscrit ON trajet.trajet_id = inscrit.trajet_id
                              WHERE e1.trajet_id = $id
                              AND e1.ville_insee = inscrit.ville_insee_depart GROUP BY e1.etape_ordre)
                           AND
                            (
                            SELECT e2.etape_ordre
                              FROM ville v2
                              INNER JOIN etape e2 ON e2.ville_insee = v2.ville_insee
                              INNER JOIN trajet ON trajet.trajet_id = e2.trajet_id
                              INNER JOIN inscrit ON trajet.trajet_id = inscrit.trajet_id
                              WHERE e2.trajet_id = $id
                              AND e2.ville_insee = inscrit.ville_insee_arrivee GROUP BY e2.etape_ordre)");


                $etapeDepart = DB::select("SELECT e1.etape_ordre
                              FROM ville v1
                              INNER JOIN etape e1 ON e1.ville_insee = v1.ville_insee
                              INNER JOIN trajet ON e1.trajet_id = trajet.trajet_id
                              INNER JOIN inscrit ON trajet.trajet_id = inscrit.trajet_id
                              WHERE trajet.trajet_id = $id
                              AND inscrit.ville_insee_depart = e1.ville_insee
                          ");


                $etapeArrivee = DB::select("SELECT e1.etape_ordre
                              FROM ville v1
                              INNER JOIN etape e1 ON e1.ville_insee = v1.ville_insee
                              INNER JOIN trajet ON e1.trajet_id = trajet.trajet_id
                              INNER JOIN inscrit ON trajet.trajet_id = inscrit.trajet_id
                              WHERE trajet.trajet_id = $id
                              AND inscrit.ville_insee_arrivee = e1.ville_insee");


                $tmpPlace = DB::select("SELECT count(DISTINCT inscrit.id) as nbPlace, $id as trajet_id
                        FROM inscrit
                        INNER JOIN trajet ON inscrit.trajet_id = trajet.trajet_id
                        INNER JOIN etape ON etape.trajet_id = trajet.trajet_id
                        WHERE trajet.trajet_id = $id
                        AND inscrit.inscription_valide = 1
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


            }

            array_push($prix, $tmpPrix);
            array_push($places,$tmpPlace);



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
            return view('dashboard.bookings.history',['reservations'=>$inscrit,'etapes'=>$etapes,'prix'=>$prix_etapes,'places'=>$places_occ]);

        }

        return view('dashboard.bookings.history',['reservations'=>$inscrit]);
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
