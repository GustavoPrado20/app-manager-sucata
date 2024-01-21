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
    Route::post('/atualizar', [Controllers\MembrosController::class, 'update'])->name('atualizar-membros');
    Route::get('/buscar', [Controllers\MembrosController::class, 'search'])->name('buscar-membros');
});

Route::get('/login', [Controllers\LoginRegistroController::class, 'index'])->name('login');

Route::prefix('/login')->group(function(){
    Route::post('/singUp', [Controllers\LoginRegistroController::class, 'registrarDiretor'])->name('registrar-diretor');
    Route::post('/singIp', [Controllers\LoginRegistroController::class, 'logarDiretor'])->name('Logar-diretor');
});

Route::get('/jogos', [Controllers\JogoController::class, 'index'])->name('jogos');

Route::prefix('/jogos')->group(function(){
    Route::post('/adicionarJogador', [Controllers\JogoController::class, 'adicionarJogador'])->name('adicionarJogador');
});