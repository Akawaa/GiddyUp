<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    protected $table = 'vehicule';

    protected $primaryKey = 'vehicule_id';

    public $timestamps = false;

    protected $fillable = [
        'vehicule_confort',
        'vehicule_place',
        'id',
        'modele_id',
        'couleur_id'];

    public function modele(){
        return $this->belongsTo('App\Modele','modele_id');
    }

}
