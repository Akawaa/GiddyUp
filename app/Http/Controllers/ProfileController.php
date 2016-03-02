<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function informations(){
        return view('dashboard/profile/profile');
    }

    public function update_informations(){

        $rules = array(
            'prenom' => 'required|max:25|aplha',
            'name' => 'required|max:50|alpha',
            'email' => 'required|email|max:255|unique:users',
            'telephone' => 'required|numeric|max:0999999999',
            'naissance' => 'required|numeric',
            'presentation' => 'max:255'
        );
        $validator = Validator::make(Input::all(),$rules);

        if($validator->fails()){
            return Redirect::to('/profile')
                ->withErrors($validator);
        }

            $users = User::find(Auth::user()->id);
            $users->name = Input::get('nom');
            $users->membre_prenom = Input::get('prenom');
            $users->email = Input::get('email');
            $users->membre_telephone = Input::get('telephone');
            $users->membre_annee_naissance = Input::get('naissance');
            $users->membre_present = Input::get('presentation');

        dd($users);

            $users->save();

            return Redirect::to('/profile');


    }

    public function universite(){

        $universites = DB::table('universite')->get();

        $sites = DB::table('site')
            ->join('universite', 'universite.universite_id', '=', 'site.universite_id')
            ->select('site.*')
            ->get();


        return view('dashboard/profile/universite',['universites'=>$universites,'sites'=>$sites]);
    }

    public function photo(){
        return view('dashboard/profile/photo');
    }

    public function voiture(){
        return view('dashboard/profile/car');
    }

    public function password(){
        return view('dashboard/profile/password');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit()
    {
        return View::make('dashboard.profile.profile');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }


}
