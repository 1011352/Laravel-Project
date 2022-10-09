<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Weapon;

class weaponsController extends Controller
{

    public function index()
    {
        $weapons = weapon::orderBy('id', 'desc')->paginate(5);
        return view('weapons.index', compact('weapons'));
    }

    public function create()
    {
        return view('weapons.create');
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
        return view('weapons.edit', compact('weapon'));
    }

    public function update(Request $request, weapon $weapon)
    {
        $request->validate([
            'weapon_1' => 'required',
            'weapon_2' => 'required',
            'description' => 'required',
        ]);

        $weapon->fill($request->post())->save();

        return redirect()->route('weapons.index')->with('success', 'Build Has Been updated successfully');
    }

    public function destroy(weapon $weapon)
    {
        $weapon->delete();
        return redirect()->route('weapons.index')->with('success', 'Build has been deleted successfully');

    }
}
