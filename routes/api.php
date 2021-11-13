<?php

use App\Http\Controllers\Api\{
    PropriedadeController,
};

use Illuminate\Support\Facades\Route;

Route::put('/propriedade/{propriedade}', [PropriedadeController::class, 'update']);
Route::delete('/propriedade/{uuid}', [PropriedadeController::class, 'destroy']);
Route::get('/propriedade/{uuid}', [PropriedadeController::class, 'show']);
Route::post('/propriedades', [PropriedadeController::class, 'store']);
Route::get('/propriedades', [PropriedadeController::class, 'index']);