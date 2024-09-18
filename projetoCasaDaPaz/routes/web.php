<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/clients',[ClientController::class,'index'])->name('clients.index');

Route::get('/clientes/{id}',[ClientController::class,'show'])->name('clients.show');

Route::get('/produtos',[ProdutoController::class,'index'])->name('produtos.index');

Route::get('/produtos/{id}',[ProdutoController::class,'show'])->name('produtos.show');
