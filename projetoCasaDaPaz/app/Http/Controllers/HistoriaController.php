<?php

namespace App\Http\Controllers;

use App\Models\Historia;
use Illuminate\Http\Request;

class HistoriaController extends Controller
{
    // 1. Listar todas as histórias
    public function index()
    {
        $historias = Historia::all();
        return response()->json($historias);
    }

    // 2. Exibir uma história específica
    public function show($id)
    {
        $historia = Historia::find($id);

        if ($historia) {
            return response()->json($historia);
        } else {
            return response()->json(['message' => 'História não encontrada'], 404);
        }
    }

    // 3. Criar uma nova história
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:100',
            'texto' => 'required|string',
        ]);

        $historia = Historia::create($validatedData);

        return response()->json(['message' => 'História criada com sucesso', 'historia' => $historia], 201);
    }

    // 4. Atualizar uma história existente
    public function update(Request $request, $id)
    {
        $historia = Historia::find($id);

        if (!$historia) {
            return response()->json(['message' => 'História não encontrada'], 404);
        }

        $validatedData = $request->validate([
            'titulo' => 'required|string|max:100',
            'texto' => 'required|string',
        ]);

        $historia->update($validatedData);

        return response()->json(['message' => 'História atualizada com sucesso', 'historia' => $historia]);
    }

    // 5. Deletar uma história
    public function destroy($id)
    {
        $historia = Historia::find($id);

        if ($historia) {
            $historia->delete();
            return response()->json(['message' => 'História excluída com sucesso']);
        } else {
            return response()->json(['message' => 'História não encontrada'], 404);
        }
    }
}
