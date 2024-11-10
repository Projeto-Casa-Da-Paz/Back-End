<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagemController extends Controller
{
    //
    public function showImage($dirname, $filename)
    {
        // Certifique-se de que o caminho está correto, levando em conta o diretório "uploads"
        $filePath = "{$dirname}/{$filename}";

        // Verifica se a imagem existe no armazenamento público
        if (Storage::disk('public')->exists($filePath)) {
            // Retorna o arquivo como resposta
            return response()->file(Storage::disk('public')->path($filePath));
        }

        // Caso não encontre, retorna uma resposta de erro
        return response()->json(['error' => 'Imagem não encontrada'], 404);
    }

}
