<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class homePage extends Controller
{
    public function home()
    {
        return view('home1');
    }
}
