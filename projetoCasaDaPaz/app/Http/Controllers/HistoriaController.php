<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Historia;
use Illuminate\Support\Facades\Storage;

class HistoriaController extends Controller
{
    public function index()
    {
        $historias = Historia::all();
        return response()->json($historias);
    }

    public function show($id)
    {
        $historia = Historia::findOrFail($id);
        return response()->json($historia);
    }

    public function store(Request $request)
    {
        $request->validate([

            'ano_fundacao' => 'nullable|date',
            'MVV' => 'nullable|string',
            'PMH' => 'nullable|string',
            'texto_institucional' => 'nullable|string',
            'foto_capa' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        $historia = new Historia();
        $historia->ano_fundacao = $request->ano_fundacao;
        $historia->MVV = $request->MVV;
        $historia->PMH = $request->PMH;
        $historia->texto_institucional = $request->texto_institucional;

        if ($request->hasFile('foto_capa')) {
            $path = $request->file('foto_capa')->store('public/fotos_capa');
            $historia->foto_capa = basename($path);
        }

        $historia->save();

        return response()->json([
            'message' => 'História criada com sucesso',
            'historia' => $historia
        ]);
    }

    public function update(Request $request, $id)
    {
        $historia = Historia::findOrFail($id);

        $request->validate([
            'ano_fundacao' => 'nullable|date',
            'MVV' => 'nullable|string',
            'PMH' => 'nullable|string',
            'texto_institucional' => 'nullable|string',
            'foto_capa' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        $historia->ano_fundacao = $request->ano_fundacao;
        $historia->MVV = $request->MVV;
        $historia->PMH = $request->PMH;
        $historia->texto_institucional = $request->texto_institucional;

        if ($request->hasFile('foto_capa')) {
            if ($historia->foto_capa) {
                Storage::delete($historia->foto_capa);
            }
            $path = $request->file('foto_capa')->store('public/fotos_capa');
            $historia->foto_capa = basename($path);
        }

        $historia->save();

        return response()->json([
            'message' => 'História atualizada com sucesso',
            'historia' => $historia
        ]);
    }

    public function destroy($id)
    {
        $historia = Historia::findOrFail($id);

        if ($historia->foto_capa) {
            Storage::delete($historia->foto_capa);
        }

        $historia->delete();

        return response()->json([
            'message' => 'História excluída com sucesso'
        ]);
    }
}
