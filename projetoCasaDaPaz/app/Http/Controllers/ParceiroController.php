<?php

namespace App\Http\Controllers;

use App\Models\Parceiro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ParceiroController extends Controller
{
    public function index()
    {
        $parceiros = Parceiro::all();
        return response()->json($parceiros);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:100',
            'classificacao' => 'required|string|max:50',
            'data_inicio' => 'required|date',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif', // Validação para imagem
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->all();

        if ($request->hasFile('imagem')) {
            $file = $request->file('imagem');
            $filePath = $file->store('parceiros', 'public');
            $data['imagem'] = $filePath;
        }

        $parceiro = Parceiro::create($data);
        return response()->json($parceiro, 201);
    }

    public function show($id)
    {
        $parceiro = Parceiro::findOrFail($id);
        return response()->json($parceiro);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'sometimes|required|string|max:100',
            'classificacao' => 'sometimes|required|string|max:50',
            'data_inicio' => 'sometimes|required|date',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $parceiro = Parceiro::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('imagem')) {
            if ($parceiro->imagem) {
                Storage::disk('public')->delete($parceiro->imagem);
            }

            $file = $request->file('imagem');
            $filePath = $file->store('parceiros', 'public');
            $data['imagem'] = $filePath;
        }

        $parceiro->update($data);
        return response()->json($parceiro);
    }

    public function destroy($id)
    {
        $parceiro = Parceiro::findOrFail($id);

        if ($parceiro->imagem) {
            Storage::disk('public')->delete($parceiro->imagem);
        }

        $parceiro->delete();
        return response()->json(null, 204);
    }
}
