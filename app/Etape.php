<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etape extends Model
{
    protected $table = 'etape';

    protected $primaryKey = 'etape_id';

    public function trajet(){
        $this->belongsTo('App\Trajet','trajet_id');
    }
}
