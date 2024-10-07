<?php

namespace App\Http\Controllers;

use App\Models\Galeria;
use Illuminate\Http\Request;

class GaleriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retornar todas as galerias ativas
        $galerias = Galeria::whereNull('deleted_at')->get(); // Soft deletes filtrando apenas os ativos
        return response()->json($galerias);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validação dos dados
        $data = $request->validate([
            'nome' => 'required|string|max:100',
            'data' => 'required|date',
            'local' => 'required|string|max:255',
        ]);

        // Criar nova galeria
        $galeria = Galeria::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Galeria criada com sucesso!',
            'galeria' => $galeria
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Exibir uma galeria específica
        $galeria = Galeria::find($id);

        if ($galeria) {
            return response()->json($galeria);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Galeria não encontrada.'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Encontrar a galeria pelo ID
        $galeria = Galeria::find($id);

        if ($galeria) {
            // Validar os dados de atualização
            $data = $request->validate([
                'nome' => 'required|string|max:100',
                'data' => 'required|date',
                'local' => 'required|string|max:255',
            ]);

            // Atualizar os dados da galeria
            $galeria->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Galeria atualizada com sucesso!',
                'galeria' => $galeria
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Galeria não encontrada.'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage (soft delete).
     */
    public function destroy(string $id)
    {
        // Excluir logicamente a galeria (soft delete)
        $galeria = Galeria::find($id);

        if ($galeria) {
            $galeria->delete();

            return response()->json([
                'success' => true,
                'message' => 'Galeria excluída com sucesso (soft delete).'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Galeria não encontrada.'
            ], 404);
        }
    }

    /**
     * Restore a soft deleted resource.
     */
    public function restore(string $id)
    {
        // Restaurar uma galeria excluída logicamente
        $galeria = Galeria::onlyTrashed()->find($id);

        if ($galeria) {
            $galeria->restore();

            return response()->json([
                'success' => true,
                'message' => 'Galeria restaurada com sucesso!',
                'galeria' => $galeria
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Galeria não encontrada.'
            ], 404);
        }
    }

    /**
     * Display a listing of soft deleted resources.
     */
    public function trashed()
    {
        // Exibir todas as galerias que foram excluídas logicamente
        $galerias = Galeria::onlyTrashed()->get();
        return response()->json($galerias);
    }
}
