<?php

namespace App\Http\Controllers;

use App\Models\Bazar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BazarController extends Controller
{

    public function index()
    {
        $bazares = Bazar::all();
        return response()->json($bazares);
    }

    public function store(Request $request)
{
    $data = $request->validate([
        'periodo_atividade' => 'required|date',
        'localidade' => 'required|string|max:255',
        'contato' => 'required|string|max:100',
        'foto' => 'nullable|string|max:100',
    ]);

    if ($request->hasFile('imagem')) {
        $imagePath = $request->file('imagem')->store('uploads', 'public');
        $data['foto'] = $imagePath;
    } else {
        $data['foto'] = null;
    }

    $bazar = Bazar::create($data);

    return response()->json([
        'success' => true,
        'message' => 'Bazar criado com sucesso!',
        'bazar' => $bazar
    ]);
}


    public function show(string $id)
    {
        $bazar = Bazar::find($id);

        if ($bazar) {
            return response()->json($bazar);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Bazar não encontrado.'
            ], 404);
        }
    }

    public function update(Request $request, string $id)
    {
        $bazar = Bazar::find($id);

        if ($bazar) {
            $data = $request->validate([
                'periodo_atividade' => 'required|date',
                'localidade' => 'required|string|max:255',
                'contato' => 'required|string|max:100',
                'imagem' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);


            if ($request->hasFile('imagem')) {
                if ($bazar->imagem) {
                    Storage::disk('public')->delete($bazar->imagem);
                }

                $imagePath = $request->file('imagem')->store('uploads', 'public');
                $data['imagem'] = $imagePath;
            }

            $bazar->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Bazar atualizado com sucesso!',
                'bazar' => $bazar
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Bazar não encontrado.'
            ], 404);
        }
    }

    public function destroy(string $id)
    {
        $bazar = Bazar::find($id);

        if ($bazar) {
            if ($bazar->imagem) {
                Storage::disk('public')->delete($bazar->imagem);
            }

            $bazar->delete();

            return response()->json([
                'success' => true,
                'message' => 'Bazar excluído com sucesso.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Bazar não encontrado.'
            ], 404);
        }
    }
}
