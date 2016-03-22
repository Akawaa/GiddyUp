<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trajet extends Model
{
    protected $table = 'trajet';

    protected $primaryKey = 'trajet_id';

    public function etapes(){
        return $this->hasMany('App\Etape','etape_id');
    }

    public function user(){
        return $this->belongsTo('App\User','id');
    }

    public function vehicule(){
        return $this->belongsTo('App\Vehicule','vehicule_id');
    }

    public function inscrits(){
        return $this->hasMany('App\Inscrit','Trajet_id');
    }

}
