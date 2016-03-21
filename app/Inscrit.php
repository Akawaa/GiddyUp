<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inscrit extends Model
{
    protected $table = 'inscrit';

    protected $primaryKey = ['id','trajet_id'];

}
