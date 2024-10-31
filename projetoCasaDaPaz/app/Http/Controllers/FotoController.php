<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($galeriaId)
    {
        $fotos = Foto::where('id_galeria', $galeriaId)->get();

        return response()->json($fotos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $galeriaId)
    {
        $dados['id_galeria'] = $galeriaId;

        // Adiciona a descrição ao array de dados
        $dados['descricao'] = $request->input('descricao');

        if ($request->hasFile('imagem')) {
            $imagePath = $request->file('imagem')->store('uploads', 'public');
            $data['imagem'] = basename($imagePath);
        }

        Foto::create($dados);

        return redirect('/fotos');
    }


    /**
     * Display the specified resource.
     */
    public function show($galeriaId, $id)
    {
        $foto = Foto::where('id_galeria', $galeriaId)->find($id);

        if ($foto) {
            return response()->json($foto);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Foto não encontrada'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $galeriaId, $id)
    {
        $foto = Foto::where('id_galeria', $galeriaId)->findOrFail($id);
        $dados = $request->only('id_galeria', 'descricao', 'imagem');

        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            if ($foto->imagem) {
                Storage::disk('public')->delete($foto->imagem);
            }

            $imagemPath = $request->file('imagem')->store('imagens', 'public');
            $dados['imagem'] = $imagemPath;
        }

        $foto->update($dados);

        return redirect('/fotos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($galeriaId, $id)
    {
        $foto = Foto::where('id_galeria', $galeriaId)->findOrFail($id);

        if ($foto->imagem) {
            Storage::disk('public')->delete($foto->imagem);
        }

        $foto->delete();

        return redirect('/fotos')->with('success', 'Foto excluída com sucesso!');
    }
}
