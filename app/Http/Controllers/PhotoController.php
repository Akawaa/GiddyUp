<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;

class PhotoController extends Controller
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

        return view('dashboard.profile.photo',['user'=>$user]);

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
        $user = User::find($id);

        $validator = Validator::make($request->all(),[
            'photo_profil' => 'required',
        ]);


        if($validator->fails()){
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }

        // checking file is valid.
        if (Input::file('photo_profil')->isValid()) {

            if($user->membre_photo != null){
                $photo = $user->membre_photo;

                unlink(public_path('img/uploads/'.$user->id.'/'.$photo));

                $user->membre_photo = null;
                $user->membre_photo_valide = null;

                $user->save();
            }


            $destinationPath = 'img/uploads/'.Auth::user()->id; // upload path
            $extension = $request->photo_profil->getClientOriginalExtension(); // getting image extension
            $fileName = 'photo_profil'.Auth::user()->id.'.'.$extension; // renameing image
            $request->photo_profil->move($destinationPath, $fileName); // uploading file to given path
            // sending back with message
            $user->membre_photo = $fileName;
            $user->membre_photo_valide = 0;

            $user->save();


            Session::flash('success', 'Upload successfully');
            return redirect('profile/picture/'.$id.'/edit')->with('status', 'Votre photo bien a été ajoutée, elle sera prochainement validée');
        }
        else {
            // sending back with error message.
            Session::flash('error', 'uploaded file is not valid')->with('status', 'Eh non :p');
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
        $user = User::find($id);

        $photo = $user->membre_photo;

        unlink(public_path('img/uploads/'.$user->id.'/'.$photo));

        $user->membre_photo = null;
        $user->membre_photo_valide = null;

        $user->save();

        return redirect('profile/picture/'.$id.'/edit')->with('status', 'Votre photo bien a été supprimée');

    }
}
