<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'question';

    protected $primaryKey = 'question_id';

    public function user(){
        return $this->belongsTo('App\User','id');
    }

    public function reponses(){
        return $this->hasMany('App\Reponse','question_id');
    }
}
