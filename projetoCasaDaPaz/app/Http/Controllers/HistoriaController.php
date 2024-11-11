<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Historia;
use Illuminate\Support\Facades\Storage;

class HistoriaController extends Controller
{
    // Método para listar todas as histórias
    public function index()
    {
        $historias = Historia::all();
        return response()->json($historias);
    }

    // Método para exibir uma história específica
    public function show($id)
    {
        $historia = Historia::findOrFail($id);
        return response()->json($historia);
    }

    // Método para criar uma nova história
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:100',
            'ano_fundacao' => 'nullable|date',
            'MVV' => 'nullable|string',
            'PMH' => 'nullable|string',
            'texto_institucional' => 'nullable|string',
            'foto_capa' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $historia = new Historia();
        $historia->titulo = $request->titulo;
        $historia->ano_fundacao = $request->ano_fundacao;
        $historia->MVV = $request->MVV;
        $historia->PMH = $request->PMH;
        $historia->texto_institucional = $request->texto_institucional;

        // Verificar se há uma imagem para upload
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

    // Método para atualizar uma história existente
    public function update(Request $request, $id)
    {
        $historia = Historia::findOrFail($id);

        $request->validate([
            'titulo' => 'required|string|max:100',
            'ano_fundacao' => 'nullable|date',
            'MVV' => 'nullable|string',
            'PMH' => 'nullable|string',
            'texto_institucional' => 'nullable|string',
            'foto_capa' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $historia->titulo = $request->titulo;
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

    // Método para excluir uma história
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
