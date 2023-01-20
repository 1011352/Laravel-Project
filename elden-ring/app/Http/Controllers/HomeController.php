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
            $weapons = Weapon::where('category_id', '=', $request->query('category'))->where('visibility', '=', '1')->paginate(5);
        } else {
            $weapons = Weapon::where('visibility', '=', '1')->paginate(5);
        }
        $categories = Category::all();
        return view('home', compact('weapons', 'categories'));
    }

    public function search(Request $request)
    {
        $categories = Category::all();
        $weapons = Weapon::where('weapon_1', 'like', '%' . $request->search . '%')
            ->where('visibility', '=', '1')
            ->orWhere('title', 'like', '%' . $request->search . '%')
            ->where('visibility', '=', '1')
            ->orWhere('weapon_2', 'like', '%' . $request->search . '%')
            ->where('visibility', '=', '1')
            ->orWhere('category_id', 'like', '%' . $request->search . '%')
            ->where('visibility', '=', '1')
            ->orWhere('description', 'like', '%' . $request->search . '%')
            ->where('visibility', '=', '1')
            ->paginate(5);
        return view('home', compact('weapons', 'categories'));
    }

}

