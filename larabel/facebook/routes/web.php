<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MensajeController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');



Route::get('home',[HomeController::class,'index'])->name('home');
Route::post('mensaje/send',[HomeController::class,'send'])->name('enviar');
Route::post('comentario/send',[HomeController::class,'comentario'])->name('comentario');

Route::post('like',[HomeController::class,'like'])->name('like');

Route::post('mensajePrivado/send',[MensajeController::class,'sendo'])->name('enviarPrivado');

Route::get('/muro',[HomeController::class, 'index'])->middleware(['auth'])->name('muro');

require __DIR__.'/auth.php';
