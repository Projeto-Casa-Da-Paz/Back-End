<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\PremioController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
/*
Route::get('/premios',[PremioController::class,'index'])->name('premios.index');

Route::get('/premios/{id}',[PremioController::class,'show'])->name('premios.show');
*/
Route::post('/login', [UsuarioController::class],'show');
