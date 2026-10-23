<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimeController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/times/criar', [TimeController::class, 'create']);
Route::post('/times', [TimeController::class, 'store'])->name('times.store');
