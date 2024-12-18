<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Historia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class HistoriaController extends Controller
{
    public function index()
    {
        $historias = Historia::all();
        return response()->json($historias);
    }

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

    public function update(Request $request, string $id)
    {
        $historia = Historia::find($id);

        if ($historia) {
            $data = $request->validate([
                'ano_fundacao' => 'nullable|date',
                'mvv' => 'nullable|string',
                'pmh' => 'nullable|string',
                'texto_institucional' => 'nullable|string',
                'foto_capa' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);
            if ($request->hasFile('foto_capa')) {
                if ($historia->foto_capa) {
                    Storage::disk('public')->delete('fotoscapas/' . $historia->foto_capa);
                }
                $imagePath = $request->file('foto_capa')->store('fotoscapas', 'public');
                $data['foto_capa'] = basename($imagePath);
            }
            $historia->fill($data);
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

    public function destroy($id)
    {
        $historia = Historia::find($id);

        if (!$historia) {
            return response()->json([
                'success' => false,
                'message' => 'História não encontrada.',
            ], 404);
        }

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
