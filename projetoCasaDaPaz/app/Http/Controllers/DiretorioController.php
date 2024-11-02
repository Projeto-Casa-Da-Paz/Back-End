<?php

namespace App\Http\Controllers;

use App\Models\Diretorio;
use Illuminate\Http\Request;

class DiretorioController extends Controller
{
    public function index()
    {
        $diretorios = Diretorio::all();
        return response()->json($diretorios);
    }

    public function show($id)
    {
        $diretorio = Diretorio::find($id);
        if ($diretorio) {
            return response()->json($diretorio);
        } else {
            return response()->json(['message' => 'Diretório não encontrado'], 404);
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:100',
        ]);

        $diretorio = Diretorio::create($validatedData);

        return response()->json(['message' => 'Diretório criado com sucesso', 'diretorio' => $diretorio], 201);
    }

    public function update(Request $request, $id)
    {
        $diretorio = Diretorio::find($id);
        if (!$diretorio) {
            return response()->json(['message' => 'Diretório não encontrado'], 404);
        }

        $validatedData = $request->validate([
            'nome' => 'required|string|max:100',
        ]);

        $diretorio->update($validatedData);

        return response()->json(['message' => 'Diretório atualizado com sucesso', 'diretorio' => $diretorio]);
    }

    public function destroy($id)
    {
        $diretorio = Diretorio::find($id);
        if ($diretorio) {
            $diretorio->delete();
            return response()->json(['message' => 'Diretório excluído com sucesso']);
        } else {
            return response()->json(['message' => 'Diretório não encontrado'], 404);
        }
    }
}
