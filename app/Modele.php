<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modele extends Model
{
    protected $table = 'modele';

    protected $primaryKey = 'modele_id';

    public function marque(){
        return $this->belongsTo('App\Marque','marque_id');
    }

    public function vehicules(){
        return $this->hasMany('App\Vehicule','model_id');
    }
}
