<?php

namespace App\Http\Controllers;

use App\Models\Bazar;
use Illuminate\Http\Request;

class BazarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $bazares = Bazar::all();
        return response()->json($bazares);
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'periodo_atividade' => 'required|datetime',
            'localidade' => 'required|string|max:255',
            'contato' => 'required|string|max:100',
            'foto' => 'nullable|string|max:100',
        ]);

        $bazar = Bazar::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Bazar criado com sucesso!',
            'bazar' => $bazar
        ]);
    }

    public function show(string $id)
    {

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


    public function update(Request $request, string $id)
    {

        $bazar = Bazar::find($id);

        if ($bazar) {

            $data = $request->validate([
                'periodo_atividade' => 'required|datetime',
                'localidade' => 'required|string|max:255',
                'contato' => 'required|string|max:100',
                'foto' => 'nullable|string|max:100',
            ]);


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

    public function destroy(string $id)
    {

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
