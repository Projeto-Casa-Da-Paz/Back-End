<?php

namespace App\Http\Controllers;

use App\Models\Campanha;
use Illuminate\Http\Request;

class CampanhaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retorna todas as campanhas ativas (sem soft delete)
        $campanhas = Campanha::whereNull('deleted_at')->get();
        return response()->json($campanhas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valida os dados recebidos
        $data = $request->validate([
            'nome_campanha' => 'required|string|max:255',
            'data_inicio' => 'required|date',
            'data_final' => 'required|date',
            'detalhes' => 'required|string|max:500',
        ]);

        // Cria uma nova campanha
        $campanha = Campanha::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Campanha criada com sucesso!',
            'campanha' => $campanha
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Exibe uma campanha específica
        $campanha = Campanha::find($id);

        if ($campanha) {
            return response()->json($campanha);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Campanha não encontrada.'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Encontra a campanha pelo ID
        $campanha = Campanha::find($id);

        if ($campanha) {
            // Valida os dados de atualização
            $data = $request->validate([
                'nome_campanha' => 'required|string|max:255',
                'data_inicio' => 'required|date',
                'data_final' => 'required|date',
                'detalhes' => 'required|string|max:500',
            ]);

            // Atualiza os dados da campanha
            $campanha->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Campanha atualizada com sucesso!',
                'campanha' => $campanha
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Campanha não encontrada.'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage (soft delete).
     */
    public function destroy(string $id)
    {
        // Excluir logicamente uma campanha
        $campanha = Campanha::find($id);

        if ($campanha) {
            $campanha->delete();

            return response()->json([
                'success' => true,
                'message' => 'Campanha excluída com sucesso (soft delete).'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Campanha não encontrada.'
            ], 404);
        }
    }

    /**
     * Restore a soft deleted resource.
     */
    public function restore(string $id)
    {
        // Restaurar uma campanha excluída logicamente
        $campanha = Campanha::onlyTrashed()->find($id);

        if ($campanha) {
            $campanha->restore();

            return response()->json([
                'success' => true,
                'message' => 'Campanha restaurada com sucesso!',
                'campanha' => $campanha
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Campanha não encontrada.'
            ], 404);
        }
    }

    /**
     * Display a listing of soft deleted resources.
     */
    public function trashed()
    {
        // Exibir todas as campanhas excluídas logicamente
        $campanhas = Campanha::onlyTrashed()->get();
        return response()->json($campanhas);
    }
}
