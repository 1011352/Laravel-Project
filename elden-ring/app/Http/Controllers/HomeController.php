<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
    public function index(Request $request)
    {
        if ($request->has('category')) {
            $weapons = Weapon::where('category_id', '=', $request->query('category'))->get();
        } else {
            $weapons = Weapon::all();
        }
        $categories = Category::all();
        return view('home', compact('weapons', 'categories'));
    }
    public function isAdmin(){

    }
}

