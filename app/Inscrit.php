<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inscrit extends Model
{
    protected $table = 'inscrit';

    protected $primaryKey = ['id','trajet_id'];

    public function user(){
        return $this->belongsTo('App\User','id');
    }

    public function trajet(){
        return $this->belongsTo('App\Trajet','trajet_id');
    }

}
