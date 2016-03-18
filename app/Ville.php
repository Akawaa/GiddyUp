<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    protected $table = 'ville';

    protected $primaryKey = 'ville_insee';

    public $timestamps = false;

    public function etapes(){
        return $this->hasMany('App\Etape','ville_insee');
    }
}
