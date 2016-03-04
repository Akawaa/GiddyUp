<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Universite extends Model
{

    protected $table = 'universite';

    protected $primaryKey = 'universite_id';

    public function sites(){
        return $this->hasMany('App\Site');
    }

}
