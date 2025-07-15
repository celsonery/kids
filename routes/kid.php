<?php

use App\Http\Controllers\KidController;
use Illuminate\Support\Facades\Route;

Route::get('/kid', [KidController::class, 'index'])->name('kid.index');
Route::post('/kid', [KidController::class, 'result'])->name('kid.result');
Route::get('/kid/import', [KidController::class, 'create'])->name('kid.create');
Route::post('/kid/import', [KidController::class, 'store'])->name('kid.store');
