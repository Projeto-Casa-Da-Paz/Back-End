<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\GaleriaController;
use App\Http\Controllers\InstituicaoController;
use App\Http\Controllers\PremioController;
use App\Http\Controllers\BazarController;
use App\Http\Controllers\CampanhaController;
use App\Http\Controllers\DoacaoController;
use App\Http\Controllers\VoluntarioController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\HistoriaController;
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

Route::get('/campanhas', [CampanhaController::class, 'index']);
Route::post('/campanhas', [CampanhaController::class, 'store']);
Route::get('/campanhas/{id}', [CampanhaController::class, 'show']);
Route::put('/campanhas/{id}', [CampanhaController::class, 'update']);
Route::delete('/campanhas/{id}', [CampanhaController::class, 'destroy']);

Route::get('/voluntarios', [VoluntarioController::class, 'index']);
Route::get('/voluntarios/{id}', [VoluntarioController::class, 'show']);
Route::post('/voluntarios', [VoluntarioController::class, 'store']);
Route::put('/voluntarios/{id}', [VoluntarioController::class, 'update']);
Route::delete('/voluntarios/{id}', [VoluntarioController::class, 'destroy']);

Route::get('/doacoes', [DoacaoController::class, 'index']);
Route::get('/doacoes/{id}', [DoacaoController::class, 'show']);
Route::post('/doacoes', [DoacaoController::class, 'store']);
Route::put('/doacoes/{id}', [DoacaoController::class, 'update']);
Route::delete('/doacoes/{id}', [DoacaoController::class, 'destroy']);

Route::get('/documentos', [DocumentoController::class, 'index']);
Route::get('/documentos/{id}', [DocumentoController::class, 'show']);
Route::post('/documentos', [DocumentoController::class, 'store']);
Route::put('/documentos/{id}', [DocumentoController::class, 'update']);
Route::delete('/documentos/{id}', [DocumentoController::class, 'destroy']);

Route::get('/historias', [HistoriaController::class, 'index']);
Route::get('/historias/{id}', [HistoriaController::class, 'show']);
Route::post('/historias', [HistoriaController::class, 'store']);
Route::put('/historias/{id}', [HistoriaController::class, 'update']);
Route::delete('/historias/{id}', [HistoriaController::class, 'destroy']);
