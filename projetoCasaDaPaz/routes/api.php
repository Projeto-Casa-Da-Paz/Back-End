<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PremioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout',  [AuthController::class, 'logout']);
    Route::post('refresh',  [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});


Route::get('/premios', [PremioController::class, 'index']); // Listar todos os prêmios
Route::post('/premios', [PremioController::class, 'store']); // Criar um novo prêmio
Route::get('/premios/{id}', [PremioController::class, 'show']); // Exibir um prêmio específico
Route::put('/premios/{id}', [PremioController::class, 'update']); // Atualizar um prêmio
Route::delete('/premios/{id}', [PremioController::class, 'destroy']); // Deletar um prêmio

