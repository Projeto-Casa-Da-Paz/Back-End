<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;

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
            'nome' => 'required|string|max:100',
            'documento' => 'required|file|mimes:jpeg,png,pdf|max:2048',
        ]);

        $documento = Documento::create($validatedData);

        return response()->json(['message' => 'Documento criado com sucesso', 'documento' => $documento], 201);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'nome' => 'required:string|max:100',
            'documento' => 'required|file|mimes:jpeg,png,pdf|max:2048',
        ]);
        $file = $request->file('file');
        $path = $file->store('uploads');
        return back()->with('success', 'Arquivo enviado com sucesso.');
    }

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

        if (!file_exists(public_path('uploads'))) {
            mkdir(public_path('uploads'), 0755, true);
        }
        $documento->update($validatedData);

        return response()->json(['message' => 'Documento atualizado com sucesso', 'documento' => $documento]);
    }


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
