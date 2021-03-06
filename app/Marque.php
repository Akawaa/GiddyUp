<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marque extends Model
{
    protected $table = 'marque';

    protected $primaryKey = 'marque_id';

    public function type(){
        return $this->belongsTo('App\Type','type_id');
    }

    public function modeles(){
        return $this->hasMany('App\Modele','marque_id');
    }
}
