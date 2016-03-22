<?php

namespace App\Http\Controllers;

use App\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\Trajet;
use Validator;
use DB;
use App\Inscrit;

use App\Http\Requests;

class InformationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        $nbTrajets = Trajet::where('id',$id)
            ->count();

        $vehicules = Vehicule::where('id',$id)
            ->get();

        $exp = DB::table('inscrit')
            ->join('trajet','trajet.trajet_id','=','inscrit.trajet_id')
            ->where('trajet.id',$id)
            ->where('trajet.trajet_date','<','curdate()')
            ->count('inscrit.id');

        $avisConducteur = DB::table('inscrit')
                ->join('trajet','trajet.trajet_id','=','inscrit.trajet_id')
                ->join('users','users.id','=','inscrit.id')
                ->where('trajet.id',$id)
                ->get();

        $avisPassager = DB::table('inscrit')
            ->join('trajet','trajet.trajet_id','=','inscrit.trajet_id')
            ->join('users','users.id','=','trajet.id')
            ->where('inscrit.id',$id)
            ->get();

        $noteConducteur = DB::table('inscrit')
        ->join('trajet','trajet.trajet_id','=','inscrit.trajet_id')
        ->where('trajet.id',$id)
        ->avg('inscrit.inscription_avis_conducteur');

        $notePassager = DB::table('inscrit')
            ->join('trajet','trajet.trajet_id','=','inscrit.trajet_id')
            ->where('inscrit.id',$id)
            ->avg('inscrit.inscription_avis_voyageur');

        return view('dashboard.profile.show',['user'=>$user,'nbTrajets'=>$nbTrajets,'vehicules'=>$vehicules,'exp'=>$exp,'avisConducteur'=>$avisConducteur,'avisPassager'=>$avisPassager,'noteConducteur'=>$noteConducteur,'notePassager'=>$notePassager]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::find($id);

        return view('dashboard.profile.profile',['user'=>$user]);
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
            'nom' => 'required|max:50',
            'prenom' => 'required|max:25',
            'naissance' => 'required|numeric',
            'telephone' => 'required|numeric|max:0999999999',
        ]);

        if($validator->fails()){
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }

        $user = User::find($id);
        $user->name = $request->nom;
        $user->membre_prenom = $request->prenom;
        $user->membre_annee_naissance = $request->naissance;
        $user->membre_telephone = $request->telephone;

        $user->save();

        return redirect('profile/'.$id.'/edit')->with('status', 'Vos informations ont été mises à jour');
    }
}
