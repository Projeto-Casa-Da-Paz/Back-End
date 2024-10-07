<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use Illuminate\Http\Request;

class FotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($galeriaId)
    {
        // Listar todas as fotos associadas a uma galeria específica
        $fotos = Foto::where('id_galeria', $galeriaId)->get();

        return response()->json($fotos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $galeriaId)
    {
        // Validar os dados enviados
        $data = $request->validate([
            'descricao' => 'nullable|string|max:255',
            'nome' => 'required|string|max:255',
        ]);

        // Criar uma nova foto associada a uma galeria
        $foto = Foto::create([
            'id_galeria' => $galeriaId,
            'descricao' => $data['descricao'],
            'nome' => $data['nome'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Foto criada com sucesso!',
            'foto' => $foto
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($galeriaId, $id)
    {
        // Exibir uma foto específica associada a uma galeria
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
        // Encontrar a foto específica
        $foto = Foto::where('id_galeria', $galeriaId)->find($id);

        if ($foto) {
            // Validar os dados atualizados
            $data = $request->validate([
                'descricao' => 'nullable|string|max:255',
                'nome' => 'required|string|max:255',
            ]);

            // Atualizar os dados da foto
            $foto->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Foto atualizada com sucesso!',
                'foto' => $foto
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Foto não encontrada'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($galeriaId, $id)
    {
        // Excluir uma foto específica
        $foto = Foto::where('id_galeria', $galeriaId)->find($id);

        if ($foto) {
            $foto->delete();

            return response()->json([
                'success' => true,
                'message' => 'Foto excluída com sucesso.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Foto não encontrada'
            ], 404);
        }
    }
}
