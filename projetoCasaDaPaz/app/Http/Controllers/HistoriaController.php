<?php

namespace App\Http\Controllers;

use App\Models\Historia;
use Illuminate\Http\Request;

class HistoriaController extends Controller
{

    public function index()
    {
        $historias = Historia::all();
        return response()->json($historias);
    }


    public function show($id)
    {
        $historia = Historia::find($id);

        if ($historia) {
            return response()->json($historia);
        } else {
            return response()->json(['message' => 'História não encontrada'], 404);
        }
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:100',
            'texto' => 'required|string',
        ]);
        //irá receber o texto formatado do quill
        $artigo = new Historia();
        $artigo->texto = $validatedData['texto'];
        $artigo->save();

        $historia = Historia::create($validatedData);

        return response()->json(['message' => 'História criada com sucesso', 'historia' => $historia], 201);
    }


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
