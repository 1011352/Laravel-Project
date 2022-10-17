<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;

class adminPage extends Controller
{
    public function index()  {
        $users = user::orderBy('id', 'desc')->paginate(5);
        return view('admin.index', compact('users'));
    }

    public function show(user $admin)  {
        return view('admin.index',compact('admin'));
    }
    public function edit(user $admin)
    {
        return view('admin.edit', compact('admin'));
    }

    public function update(Request $request, user $admin)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);

        $admin->update($request->all());

        return redirect()->route('admin.index')->with('success', 'User Has Been updated successfully');
    }

    public function destroy(user $admin)
    {
        $admin->delete();
        return redirect()->route('admin.index')->with('success', 'User has been deleted successfully');

    }


}

