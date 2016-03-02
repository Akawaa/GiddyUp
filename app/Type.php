<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'type';

    protected $primaryKey = 'type_id';

    public function marques(){
        return $this->hasMany('App\Marque','marque_id');
    }
}
