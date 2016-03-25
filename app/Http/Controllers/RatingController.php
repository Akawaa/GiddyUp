<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Validator;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $avisConducteur = DB::table('inscrit')
            ->join('trajet','trajet.trajet_id','=','inscrit.trajet_id')
            ->join('users','users.id','=','inscrit.id')
            ->where('inscrit.inscription_commentaire_voyageur','=','')
            ->where('trajet.trajet_date','<',DB::raw('curdate()'))
            ->where('trajet.id',Auth::user()->id)
            ->get();

        $avisPassager = DB::table('inscrit')
            ->join('trajet','trajet.trajet_id','=','inscrit.trajet_id')
            ->join('users','users.id','=','trajet.id')
            ->where('inscrit.inscription_commentaire_conducteur','=','')
            ->where('trajet.trajet_date','<',DB::raw('curdate()'))
            ->where('inscrit.id',Auth::user()->id)
            ->get();

        return view('dashboard.ratings.hints',['conducteurs'=>$avisConducteur,'passagers'=>$avisPassager]);
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
            'comment' => 'required',
            'note' => 'required|numeric',
        ]);

        if($validator->fails()){
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }

        if($request->place == 1){
            DB::table('inscrit')
                ->where('id', $request->idInscrit)
                ->where('trajet_id',$request->idTrajet)
                ->update(["inscription_commentaire_voyageur" => "$request->comment",'inscription_avis_voyageur'=>$request->note]);
        }else{
            DB::table('inscrit')
                ->where('id', $request->idInscrit)
                ->where('trajet_id',$request->idTrajet)
                ->update(["inscription_commentaire_conducteur" => "$request->comment",'inscription_avis_conducteur'=>$request->note]);

        }

        return Redirect::back();
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
}
