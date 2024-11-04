<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentoController extends Controller
{
    /**
     * Exibe uma lista de documentos.
     */
    public function index()
    {
        $documentos = Documento::all();
        return response()->json($documentos);
    }

    /**
     * Mostra um documento específico.
     */
    public function show($id)
    {
        $documento = Documento::find($id);

        if (!$documento) {
            return response()->json(['message' => 'Documento não encontrado.'], 404);
        }

        return response()->json($documento);
    }

    /**
     * Armazena um novo documento com upload de arquivo.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'id_diretorio' => 'required|exists:diretorios,id',
            'arquivo' => 'required|file|mimes:pdf,doc,docx,txt|max:5120', // aceita apenas arquivos de até 5MB
        ]);

        // Realiza o upload do arquivo
        if ($request->hasFile('arquivo')) {
            $path = $request->file('arquivo')->store('documentos', 'public');
        } else {
            return response()->json(['message' => 'Arquivo é obrigatório.'], 400);
        }

        $documento = Documento::create([
            'nome' => $request->nome,
            'documento' => $path,
            'id_diretorio' => $request->id_diretorio,
        ]);

        return response()->json($documento, 201);
    }

    /**
     * Atualiza um documento existente e permite substituir o arquivo.
     */
    public function update(Request $request, $id)
    {
        $documento = Documento::find($id);

        if (!$documento) {
            return response()->json(['message' => 'Documento não encontrado.'], 404);
        }

        $request->validate([
            'nome' => 'nullable|string|max:255',
            'id_diretorio' => 'exists:diretorios,id',
            'arquivo' => 'file|mimes:pdf,doc,docx,txt|max:5120',
        ]);

        // Substituir o arquivo se houver upload de um novo
        if ($request->hasFile('arquivo')) {
            // Deleta o arquivo antigo
            if ($documento->documento && Storage::disk('public')->exists($documento->documento)) {
                Storage::disk('public')->delete($documento->documento);
            }

            // Salva o novo arquivo
            $path = $request->file('arquivo')->store('documentos', 'public');
            $documento->documento = $path;
        }

        // Atualizar os demais campos
        $documento->nome = $request->nome ?? $documento->nome;
        $documento->id_diretorio = $request->id_diretorio ?? $documento->id_diretorio;
        $documento->save();

        return response()->json($documento);
    }

    /**
     * Remove um documento e o arquivo associado.
     */
    public function destroy($id)
    {
        $documento = Documento::find($id);

        if (!$documento) {
            return response()->json(['message' => 'Documento não encontrado.'], 404);
        }

        // Deleta o arquivo do armazenamento
        if ($documento->documento && Storage::disk('public')->exists($documento->documento)) {
            Storage::disk('public')->delete($documento->documento);
        }

        $documento->delete();

        return response()->json(['message' => 'Documento excluído com sucesso.']);
    }
}
