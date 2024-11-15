<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagemController extends Controller
{
    public function showImage($dirname, $filename)
    {

        $filePath = "{$dirname}/{$filename}";

        if (Storage::disk('public')->exists($filePath)) {
            return response()->file(Storage::disk('public')->path($filePath));
        }

        return response()->json(['error' => 'Imagem não encontrada'], 404);
    }
}
