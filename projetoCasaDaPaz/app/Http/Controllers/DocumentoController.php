<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentoController extends Controller
{
    public function index()
    {
        $documentos = Documento::all();
        return response()->json($documentos);
    }

    public function show($id)
    {
        $documento = Documento::find($id);

        if (!$documento) {
            return response()->json(['message' => 'Documento não encontrado.'], 404);
        }

        return response()->json($documento);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'id_diretorio' => 'required|exists:diretorios,id',
            'arquivo' => 'required|file|mimes:pdf,doc,docx,txt',
        ]);

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

    public function update(Request $request, $id)
    {
        $documento = Documento::find($id);

        if (!$documento) {
            return response()->json(['message' => 'Documento não encontrado.'], 404);
        }

        $request->validate([
            'nome' => 'nullable|string|max:255',
            'id_diretorio' => 'exists:diretorios,id',
            'arquivo' => 'file|mimes:pdf,doc,docx,txt',
        ]);

        if ($request->hasFile('arquivo')) {
            if ($documento->documento && Storage::disk('public')->exists($documento->documento)) {
                Storage::disk('public')->delete($documento->documento);
            }

            $path = $request->file('arquivo')->store('documentos', 'public');
            $documento->documento = $path;
        }

        $documento->nome = $request->nome ?? $documento->nome;
        $documento->id_diretorio = $request->id_diretorio ?? $documento->id_diretorio;
        $documento->save();

        return response()->json($documento);
    }

    public function destroy($id)
    {
        $documento = Documento::find($id);

        if (!$documento) {
            return response()->json(['message' => 'Documento não encontrado.'], 404);
        }

        if ($documento->documento && Storage::disk('public')->exists($documento->documento)) {
            Storage::disk('public')->delete($documento->documento);
        }

        $documento->delete();

        return response()->json(['message' => 'Documento excluído com sucesso.']);
    }
}
