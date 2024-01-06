<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [Controllers\HomeController::class, 'index'])->name('home');

Route::get('/membros', [Controllers\MembrosController::class, 'index'])->name('membros');

Route::prefix('/membros')->group(function(){
    Route::post('/registrar', [Controllers\MembrosController::class, 'registrar'])->name('registrar-membros');
});

Route::get('/login', [Controllers\LoginRegistroController::class, 'index'])->name('login');

Route::prefix('/login')->group(function(){
    Route::post('/singUp', [Controllers\LoginRegistroController::class, 'registrarDiretor'])->name('registrar-diretor');
    Route::post('/singIp', [Controllers\LoginRegistroController::class, 'logarDiretor'])->name('Logar-diretor');
});