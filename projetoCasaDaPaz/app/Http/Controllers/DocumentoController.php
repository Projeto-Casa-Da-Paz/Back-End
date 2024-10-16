<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;

class DocumentoController extends Controller
{
    // 1. Listar todos os documentos
    public function index()
    {
        $documentos = Documento::all();
        return response()->json($documentos);
    }

    // 2. Exibir um documento específico
    public function show($id)
    {
        $documento = Documento::find($id);

        if ($documento) {
            return response()->json($documento);
        } else {
            return response()->json(['message' => 'Documento não encontrado'], 404);
        }
    }

    // 3. Criar um novo documento
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:100',
            'documento' => 'required|string',
        ]);

        $documento = Documento::create($validatedData);

        return response()->json(['message' => 'Documento criado com sucesso', 'documento' => $documento], 201);
    }

    // 4. Atualizar um documento existente
    public function update(Request $request, $id)
    {
        $documento = Documento::find($id);

        if (!$documento) {
            return response()->json(['message' => 'Documento não encontrado'], 404);
        }

        $validatedData = $request->validate([
            'nome' => 'required|string|max:100',
            'documento' => 'required|string',
        ]);

        $documento->update($validatedData);

        return response()->json(['message' => 'Documento atualizado com sucesso', 'documento' => $documento]);
    }

    // 5. Deletar um documento
    public function destroy($id)
    {
        $documento = Documento::find($id);

        if ($documento) {
            $documento->delete();
            return response()->json(['message' => 'Documento excluído com sucesso']);
        } else {
            return response()->json(['message' => 'Documento não encontrado'], 404);
        }
    }
}
