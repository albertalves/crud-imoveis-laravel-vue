<?php
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\v1\{
    Propriedade\PropriedadeController,
    Contrato\ContratoController
};

use Illuminate\Support\Facades\Route;

Route::post('auth',         [AuthController::class, 'authenticate']);         // Autenticar usuário
Route::post('logout',       [AuthController::class, 'logout']);               // Deslogar usuário
Route::get('me',            [AuthController::class, 'getAuthenticatedUser']); // Retorna usuário pelo token
Route::post('register',     [AuthController::class, 'register']);             // Novo usuário

// middleware => auth:api
Route::prefix('/v1')->middleware('auth:api')->group(function () {
    Route::put('/propriedade/{uuid}', [PropriedadeController::class, 'update']);
    Route::delete('/propriedade/{uuid}', [PropriedadeController::class, 'destroy']);
    Route::get('/propriedade/{uuid}', [PropriedadeController::class, 'show']);
    Route::post('/propriedades', [PropriedadeController::class, 'store']);
    Route::get('/propriedades', [PropriedadeController::class, 'index']);

    Route::post('/contratos', [ContratoController::class, 'store']);
});