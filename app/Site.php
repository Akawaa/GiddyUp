<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $table = 'site';

    protected $primaryKey = 'site_id';

    public function universite(){
        return $this->belongsTo('App\Universite');
    }

    public function users(){
        return $this->hasMany('App\User');
    }
}
