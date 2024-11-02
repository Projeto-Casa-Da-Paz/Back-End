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
        if ($documento) {
            return response()->json($documento);
        } else {
            return response()->json(['message' => 'Documento não encontrado'], 404);
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'string|max:100',
            'documento' => 'required|file|mimes:jpeg,png,pdf|max:2048',
            'id_diretorio' => 'required|exists:diretorios,id',
        ]);

        // Verificando se o arquivo foi enviado
        if ($request->hasFile('documento')) {
            $path = $request->file('documento')->store('uploads');
            if ($path) {
                $validatedData['documento'] = $path;
                // Criando o documento no banco de dados
                $documento = Documento::create($validatedData);
                return response()->json(['message' => 'Documento criado com sucesso', 'documento' => $documento], 201);
            } else {
                return response()->json(['message' => 'Falha ao armazenar o arquivo'], 500);
            }
        } else {
            return response()->json(['message' => 'Arquivo não encontrado'], 400);
        }
    }

    public function upload(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:100',
            'documento' => 'required|file|mimes:jpeg,png,pdf|max:2048',
            'id_diretorio' => 'required|exists:diretorios,id',
        ]);

        if ($request->hasFile('documento')) {
            $path = $request->file('documento')->store('uploads');
            return back()->with('success', 'Arquivo enviado com sucesso. Caminho: ' . $path);
        }

        return back()->withErrors(['message' => 'Arquivo não encontrado.']);
    }

    public function update(Request $request, $id)
    {
        $documento = Documento::find($id);
        if (!$documento) {
            return response()->json(['message' => 'Documento não encontrado'], 404);
        }

        $validatedData = $request->validate([
            'nome' => 'required|string|max:100',
            'documento' => 'nullable|file|max:2048',
            'id_diretorio' => 'required|exists:diretorios,id',
        ]);

        // Armazenando o novo arquivo, se presente
        if ($request->hasFile('documento')) {
            if ($documento->documento) {
                Storage::delete($documento->documento); // Excluindo o antigo arquivo
            }
            $path = $request->file('documento')->store('uploads');
            $validatedData['documento'] = $path;
        }

        $documento->update($validatedData);

        return response()->json(['message' => 'Documento atualizado com sucesso', 'documento' => $documento]);
    }

    public function destroy($id)
    {
        $documento = Documento::find($id);
        if ($documento) {
            if ($documento->documento) {
                Storage::delete($documento->documento); // Excluindo o arquivo do armazenamento
            }
            $documento->delete();
            return response()->json(['message' => 'Documento excluído com sucesso']);
        } else {
            return response()->json(['message' => 'Documento não encontrado'], 404);
        }
    }
}
