<?php

use App\Http\Controllers\userPage;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();


Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::post('home/search', [HomeController::class, 'search'])->name('home.search');
Route::middleware(['auth', 'role_admin'])->group(function () {
    Route::resource('admin', adminPage::class);

});


Route::middleware(['auth'])->group(function () {
    Route::resource('weapons', weaponsController::class);
    Route::post('weapons/search', [weaponsController::class, 'search'])->name('weapons.search');
    Route::get('/changeVisibility', [weaponsController::class, 'updateVisibility'])->name('weapons.visibility-update');
    Route::resource('user', userPage::class);

});



