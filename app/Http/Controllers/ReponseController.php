<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reponse;
use Validator;
use DB;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;

class ReponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $validator = Validator::make($request->all(), [
            'reponse' => 'required|max:255',
            'id'=>'required',
            'question_id'=>'required',
        ]);


        if ($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }

        $reponse = new Reponse;
        $reponse->reponse_libelle = $request->reponse;
        $reponse->question_id = $request->question_id;
        $reponse->id = $request->id;

        $reponse->save();

        return redirect('/trip-offers/'.$request->trajet_id);
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
        $trajet = DB::table('reponse')
            ->join('question','question.question_id','=','reponse.question_id')
            ->get()[0]->trajet_id;


        Reponse::find($id)->delete();

        return redirect('trip-offers/'.$trajet);
    }
}
