<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'membre_prenom','membre_annee_naissance','membre_sexe','membre_telephone',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function site(){
        return $this->belongsTo('App\Site');
    }

    public function trajets(){
        return $this->hasMany('App\Trajet','id');
    }

    public function vehicules(){
        return $this->hasMany('App\Trajet','id');
    }

    public function questions(){
        return $this->hasMany('App\Question','id');
    }

    public function reponses(){
        return $this->hasMany('App\Reponse','id');
    }

    public function inscrits(){
        return $this->hasMany('App\Inscrit','id');
    }
}
