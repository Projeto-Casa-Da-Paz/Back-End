<?php

namespace App\Http\Controllers;

use App\Models\Premio;
use Illuminate\Http\Request;

class PremioController extends Controller
{
     public function index()
    {
        $premios = Premio::all();

        return response()->json($premios);
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'nome' => 'required|string|max:100',
            'categoria' => 'nullable|string|max:100',
            'data_recebimento' => 'nullable|date',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        if ($request->hasFile('imagem')) {
            $imagePath = $request->file('imagem')->store('uploads', 'public');
            $data['imagem'] = basename($imagePath);
        }

        $premio = Premio::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Prêmio criado com sucesso!',
            'premio' => $premio
        ]);
    }

    public function show(string $id)
    {
        $premio = Premio::find($id);

        if ($premio) {
            return response()->json($premio);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Prêmio não encontrado'
            ], 404);
        }
    }

    public function update(Request $request, string $id)
    {
        $premio = Premio::find($id);

        if ($premio) {
            $data = $request->validate([
                'nome' => 'required|string|max:100',
                'categoria' => 'nullable|string|max:100',
                'data_recebimento' => 'nullable|date',
                'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);


            if ($request->hasFile('imagem')) {
                $imagePath = $request->file('imagem')->store('uploads', 'public');
                $data['imagem'] = basename($imagePath);
            }

            $premio->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Prêmio atualizado com sucesso!',
                'premio' => $premio
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Prêmio não encontrado'
            ], 404);
        }
    }

    public function destroy(string $id)
    {
        $premio = Premio::find($id);

        if ($premio) {
            $premio->delete();

            return response()->json([
                'success' => true,
                'message' => 'Prêmio deletado com sucesso!'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Prêmio não encontrado'
            ], 404);
        }
    }

}
