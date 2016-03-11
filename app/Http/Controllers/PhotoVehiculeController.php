<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vehicule;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

class PhotoVehiculeController extends Controller
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
        $vehicule = Vehicule::find($id);

        return view('dashboard.profile.vehicule.picture_car',['vehicule'=>$vehicule]);
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
        $vehicule = Vehicule::find($id);

        $validator = Validator::make($request->all(),[
            'photo_car' => 'required',
        ]);


        if($validator->fails()){
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }

        // checking file is valid.
        if (Input::file('photo_car')->isValid()) {

            if($vehicule->vehicule_photo != null){
                $photo = $vehicule->vehicule_photo;

                unlink(public_path('img/uploads/'.Auth::user()->id.'/'.$photo));

                $vehicule->vehicule_photo = null;

                $vehicule->save();
            }

            $destinationPath = 'img/uploads/'.Auth::user()->id; // upload path
            $extension = $request->photo_car->getClientOriginalExtension(); // getting image extension
            $fileName = 'vehicule_'.$vehicule->vehicule_id.'.'.$extension; // renameing image
            $request->photo_car->move($destinationPath, $fileName); // uploading file to given path
            // sending back with message
            $vehicule->vehicule_photo = $fileName;

            $vehicule->save();


            return redirect('profile/car/picture/'.$id.'/edit')->with('status', 'La photo de votre véhicule à bien été ajoutée.');
        }
        else {
            // sending back with error message.
            return Redirect::back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehicule = Vehicule::find($id);

        $photo = $vehicule->vehicule_photo;

        unlink(public_path('img/uploads/'.Auth::user()->id.'/'.$photo));

        $vehicule->vehicule_photo = null;

        $vehicule->save();

        return redirect('profile/car/picture/'.$id.'/edit')->with('status', 'Votre photo bien a été supprimée');

    }
}
