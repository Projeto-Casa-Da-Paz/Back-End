<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\GaleriaController;
use App\Http\Controllers\InstituicaoController;
use App\Http\Controllers\PremioController;
use App\Http\Controllers\BazarController;
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

Route::get('premios', [PremioController::class, 'index']); // Lista todos os prêmios (ativos)
Route::get('premios/deleted', [PremioController::class, 'trashed']); // Lista os prêmios excluídos (soft deleted)
Route::post('premios/{id}/restore', [PremioController::class, 'restore']); // Restaura um prêmio excluído
Route::delete('premios/{id}/forceDelete', [PremioController::class, 'forceDelete']); // Exclui permanentemente um prêmio


Route::get('instituicoes/', [InstituicaoController::class, 'index']); // Listar todas as instituições ativas
Route::post('instituicoes/', [InstituicaoController::class, 'store']); // Criar uma nova instituição
Route::get('instituicoes/{id}', [InstituicaoController::class, 'show']); // Exibir uma instituição específica (incluindo soft deleted)
Route::put('instituicoes/{id}', [InstituicaoController::class, 'update']); // Atualizar uma instituição
Route::delete('instituicoes/{id}', [InstituicaoController::class, 'destroy']); // Excluir logicamente (soft delete)



Route::get('/galerias', [GaleriaController::class, 'index']); // Lista todas as galerias ativas
Route::post('/galerias', [GaleriaController::class, 'store']); // Cria uma nova galeria
Route::get('/galerias/{id}', [GaleriaController::class, 'show']); // Exibe uma galeria específica
Route::put('/galerias/{id}', [GaleriaController::class, 'update']); // Atualiza uma galeria específica
Route::delete('/galerias/{id}', [GaleriaController::class, 'destroy']); // Exclui logicamente uma galeria (soft delete)
Route::post('/galerias/{id}/restore', [GaleriaController::class, 'restore']); // Restaura uma galeria excluída
Route::get('/galerias/trashed', [GaleriaController::class, 'trashed']); // Lista as galerias excluídas (soft deleted)


Route::get('galerias/{galeriaId}/fotos', [FotoController::class, 'index']); // Listar todas as fotos de uma galeria
Route::post('galerias/{galeriaId}/fotos', [FotoController::class, 'store']); // Criar uma nova foto em uma galeria
Route::get('galerias/{galeriaId}/fotos/{id}', [FotoController::class, 'show']); // Exibir uma foto específica
Route::put('galerias/{galeriaId}/fotos/{id}', [FotoController::class, 'update']); // Atualizar uma foto
Route::delete('galerias/{galeriaId}/fotos/{id}', [FotoController::class, 'destroy']); // Excluir uma foto

Route::get('/bazares', [BazarController::class, 'index']);
Route::post('/bazares', [BazarController::class, 'store']);
Route::get('/bazares/{id}', [BazarController::class, 'show']);
Route::put('/bazares/{id}', [BazarController::class, 'update']);
Route::delete('/bazares/{id}', [BazarController::class, 'destroy']);
