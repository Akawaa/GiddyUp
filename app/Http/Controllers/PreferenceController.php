<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;

class PreferenceController extends Controller
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
        $user = User::find($id);

        return view('dashboard.profile.preferences',['user'=>$user]);
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
            'discussion' => 'required|numeric',
            'musique' => 'required|numeric',
            'cig' => 'required|numeric',
            'animaux' => 'required|numeric',

        ]);

        if($validator->fails()){
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }

        $user = User::find($id);
        $user->	membre_pref_dis = $request->discussion;
        $user->	membre_pref_mus = $request->musique;
        $user->	membre_pref_cig = $request->cig;
        $user->	membre_pref_ani = $request->animaux;

        $user->save();

        return redirect('profile/preferences/'.$id.'/edit')->with('status', 'Vos préférences ont été mises à jour');
    }

}
