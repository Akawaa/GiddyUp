<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AboutController extends Controller
{
    public function application(){
        return view('about.application');
    }

    public function comment(){
        return view('about.comment');
    }

    public function team(){
        return view('about.team');
    }
}
