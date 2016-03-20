<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reponse extends Model
{
    protected $table = 'reponse';

    protected $primaryKey = 'reponse_id';

    public function question(){
        return $this->belongsTo('App\Question','question_id');
    }

    public function user(){
        return $this->belongsTo('App\User','id');
    }

}
