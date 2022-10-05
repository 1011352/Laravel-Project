<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class adminPage extends Controller
{
    public function show()  {
        $data=User::all();
        return view('admin', ['users'=>$data]);
    }
}
