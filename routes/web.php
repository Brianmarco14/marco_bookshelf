<?php

use App\Http\Controllers\BacaController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/baca/{id}', [App\Http\Controllers\LandingController::class, 'show']);
Route::put('/buku/{baca}', [App\Http\Controllers\BukuController::class, 'tambah']);

Route::middleware(['auth', 'admin'])->group(function () {
    
    Route::resource('kategori', KategoriController::class);
    Route::resource('user', UserController::class);
});

Route::middleware('auth')->group(function () {
    Route::resource('buku', BukuController::class);
});

Route::resource('baca', BacaController::class);
Route::resource('/', LandingController::class);
