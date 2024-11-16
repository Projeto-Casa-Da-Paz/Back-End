<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Historia;
use Illuminate\Support\Facades\Storage;

class HistoriaController extends Controller
{
    // Retorna todas as histórias
    public function index()
    {
        $historias = Historia::all();
        return response()->json($historias);
    }

    // Cria uma nova história
    public function store(Request $request)
    {
        $request->validate([
            'ano_fundacao' => 'nullable|date',
            'MVV' => 'nullable|string',
            'PMH' => 'nullable|string',
            'texto_institucional' => 'nullable|string',
            'foto_capa' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $historia = new Historia($request->except('foto_capa'));

        // Salvar a foto de capa, se enviada
        if ($request->hasFile('foto_capa')) {
            $path = $request->file('foto_capa')->store('public/fotos_capa');
            $historia->foto_capa = basename($path);
        }

        $historia->save();

        return response()->json([
            'success' => true,
            'message' => 'História criada com sucesso!',
            'historia' => $historia,
        ]);
    }

    // Retorna uma história específica pelo ID
    public function show($id)
    {
        $historia = Historia::find($id);

        if (!$historia) {
            return response()->json([
                'success' => false,
                'message' => 'História não encontrada.',
            ], 404);
        }

        return response()->json($historia);
    }

    // Atualiza uma história existente
    public function update(Request $request, $id)
    {
        $historia = Historia::find($id);

        if (!$historia) {
            return response()->json([
                'success' => false,
                'message' => 'História não encontrada.',
            ], 404);
        }

        $request->validate([
            'ano_fundacao' => 'nullable|date',
            'MVV' => 'nullable|string',
            'PMH' => 'nullable|string',
            'texto_institucional' => 'nullable|string',
            'foto_capa' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $historia->fill($request->except('foto_capa'));

        // Atualizar a foto de capa, se enviada
        if ($request->hasFile('foto_capa')) {
            if ($historia->foto_capa) {
                Storage::delete('public/fotos_capa/' . $historia->foto_capa);
            }
            $path = $request->file('foto_capa')->store('public/fotos_capa');
            $historia->foto_capa = basename($path);
        }

        $historia->save();

        return response()->json([
            'success' => true,
            'message' => 'História atualizada com sucesso!',
            'historia' => $historia,
        ]);
    }

    // Exclui uma história existente
    public function destroy($id)
    {
        $historia = Historia::find($id);

        if (!$historia) {
            return response()->json([
                'success' => false,
                'message' => 'História não encontrada.',
            ], 404);
        }

        // Excluir a foto de capa, se existir
        if ($historia->foto_capa) {
            Storage::delete('public/fotos_capa/' . $historia->foto_capa);
        }

        $historia->delete();

        return response()->json([
            'success' => true,
            'message' => 'História excluída com sucesso!',
        ]);
    }
}
