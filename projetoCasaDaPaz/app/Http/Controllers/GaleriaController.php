<?php

namespace App\Http\Controllers;

use App\Models\Galeria;
use Illuminate\Http\Request;

class GaleriaController extends Controller
{
    public function index()
    {
        // Pega todas as galerias sem considerar soft delete
        $galerias = Galeria::all();
        return response()->json($galerias);
    }

    public function store(Request $request)
    {
        // Valida os dados do request
        $data = $request->validate([
            'nome' => 'required|string|max:100',
            'data' => 'required|date',
            'local' => 'required|string|max:255',
        ]);

        // Cria nova galeria
        $galeria = Galeria::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Galeria criada com sucesso!',
            'galeria' => $galeria
        ]);
    }

    public function show(string $id)
    {
        // Busca galeria pelo ID
        $galeria = Galeria::find($id);

        // Verifica se a galeria existe
        if ($galeria) {
            return response()->json($galeria);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Galeria não encontrada.'
            ], 404);
        }
    }

    public function update(Request $request, string $id)
    {
        // Busca galeria pelo ID
        $galeria = Galeria::find($id);

        // Verifica se a galeria existe
        if ($galeria) {
            // Valida os dados do request
            $data = $request->validate([
                'nome' => 'required|string|max:100',
                'data' => 'required|date',
                'local' => 'required|string|max:255',
            ]);

            // Atualiza a galeria
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

    public function destroy(string $id)
    {
        // Busca galeria pelo ID
        $galeria = Galeria::find($id);

        // Verifica se a galeria existe
        if ($galeria) {
            // Deleta a galeria de forma permanente
            $galeria->delete();

            return response()->json([
                'success' => true,
                'message' => 'Galeria excluída com sucesso!'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Galeria não encontrada.'
            ], 404);
        }
    }
}
