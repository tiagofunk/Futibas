<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimeController;
use App\Http\Controllers\EstadioController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/times/criar', [TimeController::class, 'create']);
Route::post('/times', [TimeController::class, 'store'])->name('times.store');

Route::get('/estadios/criar', [EstadioController::class, 'create']);
Route::post('/estadios', [EstadioController::class, 'store'])->name('estadios.store');