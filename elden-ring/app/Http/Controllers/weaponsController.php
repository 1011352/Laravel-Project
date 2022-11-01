<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;

use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
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
                return view('weapons.index', compact('weapons', 'categories','users', 'diff'));

            }
            if (Auth::user()) {
                if ($request->has('category')) {
                    $user_id = app('request')->user()->id;
                    $weapons = Weapon::where('category_id', '=', $request->query('category'))->where('user_id', $user_id)->paginate(10);
                } else {
                    $user_id = app('request')->user()->id;

                    $weapons = Weapon::where('user_id', $user_id)->paginate(10);
                }





                $categories = Category::all();
                $users = User::all();

                $date = User::where('created_at', '<=', date('Y-m-d 00:00:00'))->get();;
                $created = Carbon::parse($request->query('getDate'));
                $now = Carbon::now();
                $diff = $created->diffInDays($now);

                $to = Carbon::createFromFormat('Y-m-d H:s:i', '2015-5-5 3:30:34');
                $from = Carbon::createFromFormat('Y-m-d H:s:i', '2015-5-6 9:30:34');



                return view('weapons.index', compact('weapons', 'categories','users','diff'));
            }

        }


    public function show($id)
    {
        $weapon = Weapon::find($id);
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
            'weapon_1' => 'required',
            'weapon_2' => 'required',
            'description' => 'required',

        ]);

        weapon::create($request->post());


        return redirect()->route('weapons.index')->with('success', 'Build has been created successfully.');
    }

    public function edit($id)
    {
        $weapon = Weapon::find($id);
        if (!auth()->user()->role == 1 && auth()->user()->id != $weapon->user_id){

            abort(403 );

        }else
        $categories = Category::all();

        return view('weapons.edit', compact('weapon','categories'));
    }

    public function update(Request $request, weapon $weapon)
    {
        $request->validate([
            'weapon_1' => 'required',
            'weapon_2' => 'required',
            'description' => 'required',

        ]);

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

    public function updateVisibility(Request $request)
    {
        $weapon = Weapon::find($request->weapon_id);
        $weapon->visibility = $request->visibility;
        $weapon->save();
        return response()->json(['success'=>'Status change successfully.']);
    }


}

