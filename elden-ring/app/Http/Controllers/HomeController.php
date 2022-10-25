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
            $weapons = Weapon::where('category_id', '=', $request->query('category'))->where('visibility', '=', '0')->get();
        } else {
            $weapons = Weapon::where('visibility', '=', '0')->get();
        }
        $categories = Category::all();
        return view('home', compact('weapons', 'categories'));
    }
    public function search(Request $request)
    {
        $categories = Category::all();
        $weapons = Weapon::where('weapon_1', 'like', '%' . $request->search . '%')
            ->orWhere('weapon_2', 'like', '%' . $request->search . '%')
            ->orWhere('category_id', 'like', '%' . $request->search . '%')
            ->orWhere('description', 'like', '%' . $request->search . '%')
            ->get();
        return view('home', compact('weapons','categories'));
    }

}

