<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Couleur extends Model
{
    protected $table = 'couleur';

    protected $primaryKey = 'couleur_id';

    public function couleur(){
        return $this->hasMany('App\Vehicule','couleur_id');
    }
}
