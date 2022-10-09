<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homePage;
use App\Http\Controllers\adminPage;
use App\Http\Controllers\HomeController;
use \App\Http\Controllers\weaponsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home1',[homePage::class,'home'])->name('home1');
Route::get('/admin',[adminPage::class,'show'])->name('admin');
Auth::routes();


Route::resource('weapons',weaponsController::class);
Route::get('/home', [HomeController::class, 'index'])->name('home');
