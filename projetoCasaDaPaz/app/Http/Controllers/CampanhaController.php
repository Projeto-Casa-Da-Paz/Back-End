<?php

namespace App\Http\Controllers;

use App\Models\Campanha;
use Illuminate\Http\Request;

class CampanhaController extends Controller
{
    public function index()
    {
        $campanhas = Campanha::whereNull('deleted_at')->get();
        return response()->json($campanhas);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome_campanha' => 'required|string|max:255',
            'data_inicio' => 'required|date',
            'data_final' => 'required|date',
            'detalhes' => 'required|string|max:500',
        ]);

        $campanha = Campanha::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Campanha criada com sucesso!',
            'campanha' => $campanha
        ]);
    }

    public function show(string $id)
    {

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


    public function update(Request $request, string $id)
    {
        $campanha = Campanha::find($id);

        if ($campanha) {

            $data = $request->validate([
                'nome_campanha' => 'required|string|max:255',
                'data_inicio' => 'required|date',
                'data_final' => 'required|date',
                'detalhes' => 'required|string|max:500',
            ]);


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

    public function destroy(string $id)
    {

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


}
