<?php

use App\Http\Controllers\Api\v1\{
    Propriedade\PropriedadeController,
    Contrato\ContratoController
};

use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->group(function () {
    Route::put('/propriedade/{uuid}', [PropriedadeController::class, 'update']);
    Route::delete('/propriedade/{uuid}', [PropriedadeController::class, 'destroy']);
    Route::get('/propriedade/{uuid}', [PropriedadeController::class, 'show']);
    Route::post('/propriedades', [PropriedadeController::class, 'store']);
    Route::get('/propriedades', [PropriedadeController::class, 'index']);

    Route::post('/contratos', [ContratoController::class, 'store']);
});