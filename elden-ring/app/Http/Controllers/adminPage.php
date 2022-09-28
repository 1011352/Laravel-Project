<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Users;

class adminPage extends Controller
{
    public function show()  {
        $data=users::all();
        return view('admin', ['users'=>$data]);
    }
}
