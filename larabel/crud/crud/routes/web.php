<?php

use App\Http\Controllers\PeliculaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
    return view('auth.login');
});

// Route::post('/peliculas/store', [PeliculaController::class, 'store']);

// Route::get('/peliculas/crear', [PeliculaController::class, 'create']);

// Route::get('/peliculas/editar', [PeliculaController::class, 'create']);

// Route::get('/peliculas', [PeliculaController::class, 'index']);





// Route::delete('/pelicula/{$id}', [PeliculaController::class, 'destroy']);

Route::resource('pelicula', PeliculaController::class)->middleware('auth');


Auth::routes(['reset'=>false]);



Route::get('/home', [PeliculaController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [PeliculaController::class, 'index'])->name('home');
});
