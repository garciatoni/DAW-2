<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\segundo;
use App\Http\Controllers\MailController;
use App\Http\Controllers\test;

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


// php artisan make:controller algo
// php artisan make:auth

Route::get('/', function () {
    return view('welcome');
});

Route::get('/segundo', [segundo::class, 'show']);

Route::get('/email', [MailController::class, 'mail']);

Route::get('/form', [test::class, 'form']);
Route::post('/principal', [test::class, 'principal'])->name('tuPerfil');
use Illuminate\Http\Request;
Route::get('/formulario', [test::class, 'formlogin'])->middleware('auth');
Route::post('/muestral', [test::class, 'muestra'])->name('resultado')->middleware('auth');


// Route::get('/tercero', function () {
//     return view('tercero');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
