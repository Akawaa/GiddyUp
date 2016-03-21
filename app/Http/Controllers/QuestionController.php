<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;
use App\Question;
use DB;


use App\Http\Requests;

class QuestionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
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
            'question' => 'required|max:255',
            'id'=>'required',
            'trajet_id'=>'required',
        ]);


        if ($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }

        $question = new Question;
        $question->question_libelle = $request->question;
        $question->trajet_id = $request->trajet_id;
        $question->id = $request->id;

        $question->save();

        return redirect('/trip-offers/'.$request->trajet_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trajet = DB::table('question')
            ->get()[0]->trajet_id;

        Question::find($id)->delete();

        return redirect('trip-offers/'.$trajet);
    }
}
