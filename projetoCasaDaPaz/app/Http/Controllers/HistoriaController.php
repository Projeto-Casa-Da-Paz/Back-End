<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Historia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

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
    public function update(Request $request, string $id)
    {
        $historia = Historia::find($id);

        if ($historia) {
            // Validar os dados da requisição
            $data = $request->validate([
                'ano_fundacao' => 'nullable|date',
                'mvv' => 'nullable|string',
                'pmh' => 'nullable|string',
                'texto_institucional' => 'nullable|string',
                'foto_capa' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            // Verificar e processar a foto de capa, se enviada
            if ($request->hasFile('foto_capa')) {
                // Excluir a imagem antiga, se existir
                if ($historia->foto_capa) {
                    Storage::disk('public')->delete('fotoscapas/' . $historia->foto_capa);
                }

                // Salvar a nova imagem
                $imagePath = $request->file('foto_capa')->store('fotoscapas', 'public');
                $data['foto_capa'] = basename($imagePath);
            }

            // Sobrescrever todos os campos do modelo com os dados da requisição
            $historia->fill($data);

            // Salvar as alterações no banco de dados
            $historia->save();

            return response()->json([
                'success' => true,
                'message' => 'História atualizada com sucesso!',
                'historia' => $historia,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'História não encontrada',
            ], 404);
        }
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
