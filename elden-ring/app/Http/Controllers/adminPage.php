<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\User;

class adminPage extends Controller
{
    public function show()  {
        $data=user::all();
        return view('admin', ['user'=>$data]);
    }
}
