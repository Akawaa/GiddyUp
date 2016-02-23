<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TrajetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function recherche(){
        return view('search');
    }

    public function ajouterTrajet(){

    }
}
