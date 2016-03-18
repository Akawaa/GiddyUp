<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etape extends Model
{
    protected $table = 'etape';

    protected $primaryKey = 'etape_id';

    public function trajet(){
        return $this->belongsTo('App\Trajet','trajet_id');
    }

    public function ville(){
        return $this->belongsTo('App\Ville','ville_insee');
    }
}
