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

Route::get('/admin-home', function () {
    return view('users');
});

Route::get('/home1',[homePage::class,'home'])->name('home1');
Auth::routes();


Route::resource('weapons',weaponsController::class);
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::middleware(['auth','role_admin'])->group(function (){
    Route::resource('admin', adminPage::class);
});

