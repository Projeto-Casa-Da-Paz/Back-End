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
use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/premios', [PremioController::class, 'index']);
Route::post('/premios', [PremioController::class, 'store']);
Route::get('/premios/{id}', [PremioController::class, 'show']);
Route::put('/premios/{id}', [PremioController::class, 'update']);
Route::delete('/premios/{id}', [PremioController::class, 'destroy']);


Route::get('instituicoes/', [InstituicaoController::class, 'index']);
Route::post('instituicoes/', [InstituicaoController::class, 'store']);
Route::get('instituicoes/{id}', [InstituicaoController::class, 'show']);
Route::put('instituicoes/{id}', [InstituicaoController::class, 'update']);
Route::delete('instituicoes/{id}', [InstituicaoController::class, 'destroy']);

Route::get('/galerias', [GaleriaController::class, 'index']);
Route::post('/galerias', [GaleriaController::class, 'store']);
Route::get('/galerias/{id}', [GaleriaController::class, 'show']);
Route::put('/galerias/{id}', [GaleriaController::class, 'update']);
Route::delete('/galerias/{id}', [GaleriaController::class, 'destroy']);

Route::get('galerias/{galeriaId}/fotos', [FotoController::class, 'index']);
Route::post('galerias/{galeriaId}/fotos', [FotoController::class, 'store']);
Route::get('galerias/{galeriaId}/fotos/{id}', [FotoController::class, 'show']);
Route::put('galerias/{galeriaId}/fotos/{id}', [FotoController::class, 'update']);
Route::delete('galerias/{galeriaId}/fotos/{id}', [FotoController::class, 'destroy']);

Route::get('/fotos', [FotoController::class, 'index']);
Route::post('/fotos', [FotoController::class, 'store']);
Route::get('/fotos/{id}', [FotoController::class, 'show']);
Route::put('/fotos/{id}', [FotoController::class, 'update']);
Route::delete('/fotos/{id}', [FotoController::class, 'destroy']);

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

Route::post('/upload', [DocumentoController::class, 'upload'])->name('upload');

Route::get('/historias', [HistoriaController::class, 'index']);
Route::get('/historias/{id}', [HistoriaController::class, 'show']);
Route::post('/historias', [HistoriaController::class, 'store']);
Route::put('/historias/{id}', [HistoriaController::class, 'update']);
Route::delete('/historias/{id}', [HistoriaController::class, 'destroy']);

Route::get('/usuarios', [UsuarioController::class, 'index']);
Route::post('/usuarios', [UsuarioController::class, 'store']);
Route::get('/usuarios/{id}', [UsuarioController::class, 'show']);
Route::put('/usuarios/{id}', [UsuarioController::class, 'update']);
Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy']);
