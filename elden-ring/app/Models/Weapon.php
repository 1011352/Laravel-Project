<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class weapon extends Model
{

    use HasFactory;

    protected $fillable = ['weapon_1', 'weapon_2', 'description',];


}