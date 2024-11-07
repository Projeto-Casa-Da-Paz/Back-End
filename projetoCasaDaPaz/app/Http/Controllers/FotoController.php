<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FotoController extends Controller
{
    /**
     * Exibe a lista de fotos.
     */
    public function index()
    {
        $fotos = Foto::all();
        return response()->json($fotos);
    }

    /**
     * Mostra uma foto específica.
     */
    public function show($id)
    {
        $foto = Foto::find($id);

        if (!$foto) {
            return response()->json(['message' => 'Foto não encontrada.'], 404);
        }

        return response()->json($foto);
    }

    /**
     * Armazena uma nova foto com upload de imagem e arquivo.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_galeria' => 'required|exists:galerias,id',
            'descricao' => 'nullable|string|max:255',
            'imagem' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'file' => 'nullable|file|max:10240', // Valida o arquivo opcional, com tamanho máximo de 10 MB
        ]);

        // Lidar com o upload da imagem
        $path = $request->file('imagem')->store('fotos', 'public');

        // Lidar com o upload do arquivo
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('arquivos', 'public');
        }

        $foto = Foto::create([
            'id_galeria' => $request->id_galeria,
            'descricao' => $request->descricao,
            'nome' => $path,
            'file' => $filePath,
        ]);

        return response()->json($foto, 201);
    }

    /**
     * Atualiza uma foto existente e permite substituir a imagem e o arquivo.
     */
    public function update(Request $request, $id)
    {
        $foto = Foto::find($id);

        if (!$foto) {
            return response()->json(['message' => 'Foto não encontrada.'], 404);
        }

        $request->validate([
            'id_galeria' => 'exists:galerias,id',
            'descricao' => 'nullable|string|max:255',
            'imagem' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'file' => 'nullable|file|max:10240',
        ]);

        // Substituir imagem se houver upload de uma nova imagem
        if ($request->hasFile('imagem')) {
            if ($foto->nome && Storage::disk('public')->exists($foto->nome)) {
                Storage::disk('public')->delete($foto->nome);
            }
            $foto->nome = $request->file('imagem')->store('fotos', 'public');
        }

        // Substituir arquivo se houver upload de um novo arquivo
        if ($request->hasFile('file')) {
            if ($foto->file && Storage::disk('public')->exists($foto->file)) {
                Storage::disk('public')->delete($foto->file);
            }
            $foto->file = $request->file('file')->store('arquivos', 'public');
        }

        // Atualizar os demais campos
        $foto->id_galeria = $request->id_galeria ?? $foto->id_galeria;
        $foto->descricao = $request->descricao ?? $foto->descricao;
        $foto->save();

        return response()->json($foto);
    }

    /**
     * Remove uma foto e sua imagem e arquivo do armazenamento.
     */
    public function destroy($id)
    {
        $foto = Foto::find($id);

        if (!$foto) {
            return response()->json(['message' => 'Foto não encontrada.'], 404);
        }

        // Deleta a imagem do armazenamento
        if ($foto->nome && Storage::disk('public')->exists($foto->nome)) {
            Storage::disk('public')->delete($foto->nome);
        }

        // Deleta o arquivo do armazenamento
        if ($foto->file && Storage::disk('public')->exists($foto->file)) {
            Storage::disk('public')->delete($foto->file);
        }

        $foto->delete();

        return response()->json(['message' => 'Foto excluída com sucesso.']);
    }
}
