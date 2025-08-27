<?php

use App\Http\Controllers\KidController;
use Illuminate\Support\Facades\Route;

Route::get('/kid', [KidController::class, 'index'])->name('kid.index');
Route::post('/kid', [KidController::class, 'result'])->name('kid.result');
Route::get('/kid/import', [KidController::class, 'create'])
    ->middleware(['can:access-imports'])
    ->name('kid.create');
Route::post('/kid/import', [KidController::class, 'import'])
    ->middleware(['can:access-imports'])
    ->name('kid.import');
//Route::post('/kid/store', [KidController::class, 'store'])->name('kid.store');
//Route::delete('/kid', [KidController::class, 'destroy'])->name('kid.destroy');
