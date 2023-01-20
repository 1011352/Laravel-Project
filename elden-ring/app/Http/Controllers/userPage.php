<?php

namespace App\Http\Controllers;


use App\Models\Weapon;
use Illuminate\Http\Request;
use App\Models\User;

class userPage extends Controller
{
    public function index()
    {
        $user_id = app('request')->user()->id;

        $users = User::where('id', $user_id)->get();
        return view('user.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        if (auth()->user()->id != $user->id) {

            abort(403);

        } else
            return view('user.edit', compact('user'));
    }

    public function update(Request $request, user $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $user->update($request->all());

        return redirect()->route('user.index')->with('success', 'User Has Been updated successfully');
    }


}

