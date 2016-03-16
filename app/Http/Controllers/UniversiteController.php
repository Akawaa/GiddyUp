<?php

namespace App\Http\Controllers;

use App\Universite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use Validator;
use Illuminate\Support\Facades\Redirect;
use DB;

use App\Http\Requests;

class UniversiteController extends Controller
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
        $universites = Universite::all();

        $user = User::find($id);

        if(Auth::user()->site_id == null){
            $idUniversite = 0;
            $sites = null;
            $site = 0;
        }else{
            $idUniversite = DB::table('universite')
                ->join('site','site.universite_id','=','universite.universite_id')
                ->join('users','users.site_id','=','site.site_id')
                ->select('universite.universite_id')
                ->where('users.id',$id)
                ->get()[0]->universite_id;

            $sites = DB::table('universite')
                ->join('site','site.universite_id','=','universite.universite_id')
                ->select('site.*')
                ->where('universite.universite_id',$idUniversite)
                ->get();


            $site = DB::table('users')
                ->join('site','users.site_id','=','site.site_id')
                ->select('site.*')
                ->where('users.id',$id)
                ->get()[0]->site_id;
        }


        return view('dashboard.profile.universite',['user'=>$user,'universites'=>$universites,'sites'=>$sites,'siteCourant'=>$site,'universiteCourante'=> $idUniversite]);
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
            'universite' => 'required|numeric',
            'site' => 'required|numeric',
        ]);

        if($validator->fails()){
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }

        $user = User::find($id);
        $user->site_id = $request->site;

        $user->save();

        return redirect('profile/university/'.$id.'/edit')->with('status', 'Votre site universitaire à été mis à jour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->site_id = null;

        $user->save();

        return redirect('profile/university/'.$id.'/edit')->with('status', 'Votre site universitaire à été supprimé');
    }



    public function get_site(){

        $sites = DB::table('universite')
            ->join('site','site.universite_id','=','universite.universite_id')
            ->select('site.*')
            ->where('universite.universite_id',$_POST['universite'])
            ->get();


        $json=json_encode($sites);
        echo $json;

    }
}
