<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\GaleriaController;
use App\Http\Controllers\InstituicaoController;
use App\Http\Controllers\PremioController;
use App\Http\Controllers\BazarController;
use App\Http\Controllers\ColaboradorController;
use App\Http\Controllers\DiretorioController;
use App\Http\Controllers\DoacaoController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\HistoriaController;
use App\Http\Controllers\ImagemController;
use App\Http\Controllers\ParceiroController;
use App\Http\Controllers\RedeSocialController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VoluntarioController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::get('me', [AuthController::class, 'me']);

Route::get('/imagem/{dirname}/{filename}', [ImagemController::class, 'showImage']);

Route::get('/premios', [PremioController::class, 'index']);
Route::get('/premios/{id}', [PremioController::class, 'show']);

Route::get('/instituicoes/', [InstituicaoController::class, 'index']);
Route::get('/instituicoes/{id}', [InstituicaoController::class, 'show']);

Route::get('/instituicoes/{instituicaoId}/enderecos', [EnderecoController::class, 'index']);
Route::get('/instituicoes/{instituicaoId}/enderecos/{id}', [EnderecoController::class, 'show']);

Route::get('/instituicoes/{instituicaoId}/redes-sociais', [RedeSocialController::class, 'index']);
Route::get('/instituicoes/{instituicaoId}/redes-sociais/{id}', [RedeSocialController::class, 'show']);

Route::get('/voluntarios', [VoluntarioController::class, 'index']);
Route::get('/voluntarios/{id}', [VoluntarioController::class, 'show']);
Route::post('/voluntarios', [VoluntarioController::class, 'store']);

Route::get('/galerias', [GaleriaController::class, 'index']);
Route::get('/galerias/{id}', [GaleriaController::class, 'show']);

Route::get('/galerias/{galeriaId}/fotos', [FotoController::class, 'index']);
Route::get('/galerias/{galeriaId}/fotos/{id}', [FotoController::class, 'show']);
Route::get('/fotos', [FotoController::class, 'index']);
Route::get('/fotos/{id}', [FotoController::class, 'show']);

Route::get('/bazares', [BazarController::class, 'index']);
Route::get('/bazares/{id}', [BazarController::class, 'show']);

Route::get('/colaboradores', [ColaboradorController::class, 'index']);
Route::get('/colaboradores/{id}', [ColaboradorController::class, 'show']);

Route::get('/doacoes', [DoacaoController::class, 'index']);
Route::get('/doacoes/{id}', [DoacaoController::class, 'show']);

Route::get('/diretorios', [DiretorioController::class, 'index']);
Route::get('/diretorios/{id}', [DiretorioController::class, 'show']);

Route::get('/historias', [HistoriaController::class, 'index']);
Route::get('/historias/{id}', [HistoriaController::class, 'show']);

Route::get('/parceiros', [ParceiroController::class, 'index']);
Route::get('/parceiros/{id}', [ParceiroController::class, 'show']);

Route::get('redes-sociais', [RedeSocialController::class, 'index']);
Route::get('redes-sociais/{id}', [RedeSocialController::class, 'show']);

Route::middleware('auth:api')->group(function () {
    Route::post('/premios', [PremioController::class, 'store']);
    Route::post('/premios/{id}', [PremioController::class, 'update']);
    Route::delete('/premios/{id}', [PremioController::class, 'destroy']);

    Route::post('redes-sociais', [RedeSocialController::class, 'store']);
    Route::post('redes-sociais/{id}', [RedeSocialController::class, 'update']);
    Route::delete('redes-sociais/{id}', [RedeSocialController::class, 'destroy']);

    Route::post('/instituicoes/', [InstituicaoController::class, 'store']);
    Route::post('/instituicoes/{id}', [InstituicaoController::class, 'update']);
    Route::delete('/instituicoes/{id}', [InstituicaoController::class, 'destroy']);

    Route::post('/instituicoes/{instituicaoId}/enderecos', [EnderecoController::class, 'store']);
    Route::post('/instituicoes/{instituicaoId}/enderecos/{id}', [EnderecoController::class, 'update']);
    Route::delete('/instituicoes/{instituicaoId}/enderecos/{id}', [EnderecoController::class, 'destroy']);

    Route::post('/instituicoes/{instituicaoId}/redes-sociais', [RedeSocialController::class, 'store']);
    Route::post('/instituicoes/{instituicaoId}/redes-sociais/{id}', [RedeSocialController::class, 'update']);
    Route::delete('/instituicoes/{instituicaoId}/redes-sociais/{id}', [RedeSocialController::class, 'destroy']);

    Route::post('/voluntarios/{id}', [VoluntarioController::class, 'update']);
    Route::delete('/voluntarios/{id}', [VoluntarioController::class, 'destroy']);

    Route::post('/galerias', [GaleriaController::class, 'store']);
    Route::post('/galerias/{id}', [GaleriaController::class, 'update']);
    Route::delete('/galerias/{id}', [GaleriaController::class, 'destroy']);

    Route::post('/galerias/{galeriaId}/fotos', [FotoController::class, 'store']);
    Route::post('/galerias/{galeriaId}/fotos/{id}', [FotoController::class, 'update']);
    Route::delete('/galerias/{galeriaId}/fotos/{id}', [FotoController::class, 'destroy']);
    Route::delete('/galerias/{galeriaId}/fotos/deleteAll', [FotoController::class, 'deleteAllByGaleria']);

    Route::post('/fotos', [FotoController::class, 'store']);
    Route::post('/fotos/{id}', [FotoController::class, 'update']);
    Route::delete('/fotos/{id}', [FotoController::class, 'destroy']);

    Route::post('/bazares', [BazarController::class, 'store']);
    Route::post('/bazares/{id}', [BazarController::class, 'update']);
    Route::delete('/bazares/{id}', [BazarController::class, 'destroy']);

    Route::post('/colaboradores', [ColaboradorController::class, 'store']);
    Route::post('/colaboradores/{id}', [ColaboradorController::class, 'update']);
    Route::delete('/colaboradores/{id}', [ColaboradorController::class, 'destroy']);

    Route::post('/doacoes', [DoacaoController::class, 'store']);
    Route::post('/doacoes/{id}', [DoacaoController::class, 'update']);
    Route::delete('/doacoes/{id}', [DoacaoController::class, 'destroy']);

    Route::post('/diretorios', [DiretorioController::class, 'store']);
    Route::post('/diretorios/{id}', [DiretorioController::class, 'update']);
    Route::delete('/diretorios/{id}', [DiretorioController::class, 'destroy']);

    Route::post('/historias', [HistoriaController::class, 'store']);
    Route::post('/historias/{id}', [HistoriaController::class, 'update']);
    Route::delete('/historias/{id}', [HistoriaController::class, 'destroy']);

    Route::post('/parceiros', [ParceiroController::class, 'store']);
    Route::post('/parceiros/{id}', [ParceiroController::class, 'update']);
    Route::delete('/parceiros/{id}', [ParceiroController::class, 'destroy']);
});
Route::get('/usuarios', [UsuarioController::class, 'index']);
Route::post('/usuarios', [UsuarioController::class, 'store']);
Route::get('/usuarios/{id}', [UsuarioController::class, 'show']);
Route::post('/usuarios/{id}', [UsuarioController::class, 'update']);
Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy']);
