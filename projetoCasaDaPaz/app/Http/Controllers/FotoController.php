<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FotoController extends Controller
{

    public function index()
    {
        $fotos = Foto::all();
        return response()->json($fotos);
    }


    public function show($id)
    {
        $foto = Foto::find($id);

        if (!$foto) {
            return response()->json(['message' => 'Foto não encontrada.'], 404);
        }

        return response()->json($foto);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_galeria' => 'required|exists:galerias,id',
            'imagens.*' => 'required|image|mimes:jpeg,png,jpg,gif',
            'file' => 'nullable|file',
        ]);

        $uploadedFotos = [];

        if ($request->hasFile('imagens')) {
            foreach ($request->file('imagens') as $imagem) {
                $path = $imagem->store('fotos', 'public');
                $uploadedFotos[] = Foto::create([
                    'id_galeria' => $request->id_galeria,
                    'nome' => $path,
                    'file' => $request->file ? $request->file('file')->store('arquivos', 'public') : null,
                ]);
            }
        }

        return response()->json(['fotos' => $uploadedFotos], 201);
    }

    public function update(Request $request, $id)
    {
        $foto = Foto::find($id);

        if (!$foto) {
            return response()->json(['message' => 'Foto não encontrada.'], 404);
        }

        $request->validate([
            'id_galeria' => 'exists:galerias,id',
            'imagem' => 'image|mimes:jpeg,png,jpg,gif',
            'file' => 'nullable|file',
        ]);

        if ($request->hasFile('imagem')) {
            if ($foto->nome && Storage::disk('public')->exists($foto->nome)) {
                Storage::disk('public')->delete($foto->nome);
            }
            $foto->nome = $request->file('imagem')->store('fotos', 'public');
        }

        if ($request->hasFile('file')) {
            if ($foto->file && Storage::disk('public')->exists($foto->file)) {
                Storage::disk('public')->delete($foto->file);
            }
            $foto->file = $request->file('file')->store('arquivos', 'public');
        }

        $foto->id_galeria = $request->id_galeria ?? $foto->id_galeria;
        $foto->descricao = $request->descricao ?? $foto->descricao;
        $foto->save();

        return response()->json($foto);
    }

    public function deleteAllByGaleria($galeriaId)
    {
        $deletedRows = Foto::where('id_galeria', $galeriaId)->delete();
        if ($deletedRows > 0) {
            return response()->json(['message' => 'Todas as fotos da galeria foram deletadas com sucesso!'], 200);
        } else {
            return response()->json(['message' => 'Nenhuma foto encontrada para esta galeria.'], 404);
        }
    }
    public function destroy($id)
    {
        $foto = Foto::find($id);

        if (!$foto) {
            return response()->json(['message' => 'Foto não encontrada.'], 404);
        }

        if ($foto->nome && Storage::disk('public')->exists($foto->nome)) {
            Storage::disk('public')->delete($foto->nome);
        }

        if ($foto->file && Storage::disk('public')->exists($foto->file)) {
            Storage::disk('public')->delete($foto->file);
        }

        $foto->delete();

        return response()->json(['message' => 'Foto excluída com sucesso.']);
    }
}
