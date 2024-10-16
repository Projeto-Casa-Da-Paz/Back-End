<?php

namespace App\Http\Controllers;

use App\Models\Doacao;
use Illuminate\Http\Request;

class DoacaoController extends Controller
{
    // 1. Listar todas as doações
    public function index()
    {
        $doacoes = Doacao::all();
        return response()->json($doacoes);
    }

    // 2. Exibir uma doação específica
    public function show($id)
    {
        $doacao = Doacao::find($id);

        if ($doacao) {
            return response()->json($doacao);
        } else {
            return response()->json(['message' => 'Doação não encontrada'], 404);
        }
    }

    // 3. Criar uma nova doação
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'metodo_pagamento' => 'required|string|max:255',
            'conta_destino' => 'required|string|max:255',
        ]);

        $doacao = Doacao::create($validatedData);

        return response()->json(['message' => 'Doação registrada com sucesso', 'doacao' => $doacao], 201);
    }

    // 4. Atualizar uma doação existente
    public function update(Request $request, $id)
    {
        $doacao = Doacao::find($id);

        if (!$doacao) {
            return response()->json(['message' => 'Doação não encontrada'], 404);
        }

        $validatedData = $request->validate([
            'metodo_pagamento' => 'required|string|max:255',
            'conta_destino' => 'required|string|max:255',
        ]);

        $doacao->update($validatedData);

        return response()->json(['message' => 'Doação atualizada com sucesso', 'doacao' => $doacao]);
    }

    // 5. Deletar uma doação
    public function destroy($id)
    {
        $doacao = Doacao::find($id);

        if ($doacao) {
            $doacao->delete();
            return response()->json(['message' => 'Doação excluída com sucesso']);
        } else {
            return response()->json(['message' => 'Doação não encontrada'], 404);
        }
    }
}
