<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/*Route::get('/client/{id}', function (int $id) {
    //buscar o id no bd
    //fzr validate dos dados do cleinte
    dd($id);
}); */


Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
Route::get('clients/{id}', [ClientController::class, 'show'])->name('clients.show');
