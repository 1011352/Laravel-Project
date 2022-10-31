<?php

namespace App\Models;


use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;


class Weapon extends Model
{

    use HasFactory;


    protected $fillable = ['weapon_1', 'weapon_2', 'description', 'category_id', 'user_id','visibility'];

    protected static function booted()
    {
        static::creating(function ($weapons) {
            $weapons->user_id = Auth::id();
        });
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }




}
