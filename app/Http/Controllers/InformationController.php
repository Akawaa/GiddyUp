<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\User;
use Validator;

use App\Http\Requests;

class InformationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
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
