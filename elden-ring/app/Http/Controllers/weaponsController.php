<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Weapon;
use Illuminate\Support\Facades\Auth;

class weaponsController extends Controller
{

        public function index(Request $request)
        {
            if ($request->has('category')) {
                $weapons = Weapon::where('category_id', '=', $request->query('category'))->get();
            } elseif(Auth::user()->role){
                $weapons = Weapon::all();
            } else {
                $user_id=app('request')->user()->id;

                $weapons = Weapon::where('user_id',$user_id )->get();
            }

            $categories = Category::all();

            return view('weapons.index', compact('weapons', 'categories'));

        }
    public function create()
    {
        $categories = Category::all();
        return view('weapons.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'weapon_1' => 'required',
            'weapon_2' => 'required',
            'description' => 'required',
        ]);

        weapon::create($request->post());


        return redirect()->route('weapons.index')->with('success', 'Build has been created successfully.');
    }

    public function show(weapon $weapon)
    {
        return view('weapons.index', compact('weapon'));
    }

    public function edit(weapon $weapon)
    {
        $categories = Category::all();
        return view('weapons.edit', compact('weapon','categories'));
    }

    public function update(Request $request, weapon $weapon)
    {

        $weapon->update($request->all());

        return redirect()->route('weapons.index')->with('success', 'Build Has Been updated successfully');
    }

    public function destroy(weapon $weapon)
    {
        $weapon->delete();
        return redirect()->route('weapons.index')->with('success', 'Build has been deleted successfully');

    }

    public function search(Request $request)
    {
        $categories = Category::all();
        $weapons = Weapon::where('weapon_1', 'like', '%' . $request->search . '%')
            ->orWhere('weapon_2', 'like', '%' . $request->search . '%')
            ->orWhere('category_id', 'like', '%' . $request->search . '%')
            ->orWhere('description', 'like', '%' . $request->search . '%')
            ->get();
        return view('weapons.index', compact('weapons','categories'));
    }
}
