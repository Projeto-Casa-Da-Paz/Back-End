<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
/*
Route::get('/client/{id}', function (int $id) {
    //buscar o id no banco de dados
    //fazer validação dos dados do cliente
    //buscar informações do cliente no serasa
    //atualizar alguma informação do cliente no banco de dados
    dd($id);
});
*/
Route::get('/clients',[ClientController::class,'index'])->name('clients.index');

Route::get('/clientes/{id}',[ClientController::class,'show'])->name('clients.show');//metodo de mostrar - show

Route::get('/produtos',[ProdutoController::class,'index'])->name('produtos.index');

Route::get('/produtos/{id}',[ProdutoController::class,'show'])->name('produtos.show');
