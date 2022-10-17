<?php

namespace App\Http\Controllers;

use App\Models\weapon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $weapons = weapon::all();
        return view('home', compact('weapons'));
    }
    public function isAdmin(){

    }
}

