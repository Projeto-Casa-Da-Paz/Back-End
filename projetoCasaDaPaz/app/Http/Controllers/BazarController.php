<?php

namespace App\Http\Controllers;

use App\Models\Bazar;
use Illuminate\Http\Request;

class BazarController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /*public function __construct()
    {
        $this->middleware('auth:api'); // Acesso apenas com o login
    }
*/
    public function index()
    {
        // Retornar todos os bazares
        $bazares = Bazar::all();
        return response()->json($bazares);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validação dos dados
        $data = $request->validate([
            'periodo_atividade' => 'required|datetime', // Período de atividade é um campo datetime
            'localidade' => 'required|string|max:255',
            'contato' => 'required|string|max:100',
            'foto' => 'nullable|string|max:100',
        ]);

        // Criar novo bazar
        $bazar = Bazar::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Bazar criado com sucesso!',
            'bazar' => $bazar
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Exibir um bazar específico
        $bazar = Bazar::find($id);

        if ($bazar) {
            return response()->json($bazar);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Bazar não encontrado.'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Encontrar o bazar pelo ID
        $bazar = Bazar::find($id);

        if ($bazar) {
            // Validar os dados de atualização
            $data = $request->validate([
                'periodo_atividade' => 'required|datetime',
                'localidade' => 'required|string|max:255',
                'contato' => 'required|string|max:100',
                'foto' => 'nullable|string|max:100',
            ]);

            // Atualizar os dados do bazar
            $bazar->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Bazar atualizado com sucesso!',
                'bazar' => $bazar
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Bazar não encontrado.'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Excluir permanentemente o bazar
        $bazar = Bazar::find($id);

        if ($bazar) {
            $bazar->delete();

            return response()->json([
                'success' => true,
                'message' => 'Bazar excluído com sucesso.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Bazar não encontrado.'
            ], 404);
        }
    }
}
