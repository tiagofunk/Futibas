<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimeController;
use App\Http\Controllers\EstadioController;
use App\Http\Controllers\CampeonatoController;
use App\Http\Controllers\EdicaoController;
use App\Http\Controllers\JogoController;
use App\Http\Controllers\JogadorController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/times', [TimeController::class, 'consultarPorNome']);
Route::get('/times/criar', [TimeController::class, 'create']);
Route::post('/times', [TimeController::class, 'store'])->name('times.store');

Route::get('/estadios', [EstadioController::class, 'consultarPorNome']);
Route::get('/estadios/criar', [EstadioController::class, 'create']);
Route::post('/estadios', [EstadioController::class, 'store'])->name('estadios.store');

Route::get('/campeonatos/criar', [CampeonatoController::class, 'create']);
Route::post('/campeonatos', [CampeonatoController::class, 'store'])->name('campeonatos.store');

Route::get('/edicoes/criar', [EdicaoController::class, 'create']);
Route::post('/edicoes', [EdicaoController::class, 'store'])->name('edicoes.store');

Route::get('/jogos/criar', [JogoController::class, 'create']);
Route::post('/jogos', [JogoController::class, 'store'])->name('jogos.store');
Route::get('/jogos/consultar', [JogoController::class, 'consultar'])->name('jogos.consultar');
Route::get('/jogos/{id}', [JogoController::class, 'show'])->name('jogos.show');
Route::get('/jogos/{id}/editar', [JogoController::class, 'edit'])->name('jogos.edit');

Route::get('/jogadores/criar', [JogadorController::class, 'create'])->name('jogadores.create');
Route::post('/jogadores', [JogadorController::class, 'store'])->name('jogadores.store');