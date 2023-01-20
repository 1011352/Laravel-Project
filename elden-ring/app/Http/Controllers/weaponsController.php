<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Weapon;
use Illuminate\Support\Facades\Auth;
use function Symfony\Component\String\u;

class weaponsController extends Controller
{

    public function index(Request $request)
    {
        if (Auth::user()->role) {
            if ($request->has('category')) {
                $weapons = Weapon::where('category_id', '=', $request->query('category'))->paginate(10);
            } else {
                $weapons = Weapon::paginate(10);
            }
            $categories = Category::all();
            $users = User::all();

            $diff = '10';
            return view('weapons.index', compact('weapons', 'categories', 'users', 'diff'));

        }
        if (Auth::user()) {
            if ($request->has('category')) {
                $user_id = app('request')->user()->id;
                $weapons = Weapon::where('category_id', '=', $request->query('category'))
                    ->where('user_id', $user_id)
                    ->paginate(10);
            } else {
                $user_id = app('request')->user()->id;

                $weapons = Weapon::where('user_id', $user_id)->paginate(10);
            }


            $categories = Category::all();
            $users = User::all();


            return view('weapons.index', compact('weapons', 'categories', 'users'));
        }

    }


    public function show(Weapon $weapon)
    {

        return view('weapons.show', compact('weapon'));
    }

    public function create()
    {

        $categories = Category::all();
        return view('weapons.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'started_at' => 'nullable',
            'ended_at' => 'nullable',

        ]);

        User::create($request->post());


        return redirect()->route('home');
    }

    public function edit($id)
    {
        $weapon = Weapon::find($id);
        if (!auth()->user()->role == 1 && auth()->user()->id != $weapon->user_id) {

            abort(403);

        } else
            $categories = Category::all();

        return view('weapons.edit', compact('weapon', 'categories'));
    }

    public function update(Request $request, weapon $weapon)
    {
        $request->validate([
            'title' => 'required',
            'weapon_1' => 'required',
            'weapon_2' => 'required',
            'description' => 'required',

        ]);

        $weapon->update($request->all());

        return redirect()->route('weapons.index')->with('success', 'Build Has Been updated successfully');
    }

    public function destroy($id)
    {

        $weapon = Weapon::find($id);
        if (!auth()->user()->role == 1 && auth()->user()->id != $weapon->user_id) {
            abort(403);

        } else
            $weapon->delete();
        return redirect()->route('weapons.index')->with('success', 'Build has been deleted successfully');

    }

    public function search(Request $request)
    {

        if (Auth::user()->role) {
            $categories = Category::all();
            $weapons = Weapon::where('weapon_1', 'like', '%' . $request->search . '%')
                ->orWhere('weapon_2', 'like', '%' . $request->search . '%')
                ->orWhere('category_id', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%')
                ->orWhere('title', 'like', '%' . $request->search . '%')
                ->get();
            return view('weapons.index', compact('weapons', 'categories'));
        }


        if (Auth::user()) {
            $user_id = app('request')->user()->id;
            $categories = Category::all();
            $weapons = Weapon::where('weapon_1', 'like', '%' . $request->search . '%')
                ->where('user_id', $user_id)
                ->orWhere('weapon_2', 'like', '%' . $request->search . '%')
                ->where('user_id', $user_id)
                ->orWhere('category_id', 'like', '%' . $request->search . '%')
                ->where('user_id', $user_id)
                ->orWhere('description', 'like', '%' . $request->search . '%')
                ->where('user_id', $user_id)
                ->orWhere('title', 'like', '%' . $request->search . '%')
                ->where('user_id', $user_id)
                ->get();

        }
        return view('weapons.index', compact('weapons', 'categories'));

    }

    public function updateVisibility(Request $request)
    {

        $weapon = Weapon::find($request->weapon_id);
        $weapon->visibility = $request->visibility;
        $weapon->save();
        return response()->json(['success' => 'Status change successfully.']);
    }


}

