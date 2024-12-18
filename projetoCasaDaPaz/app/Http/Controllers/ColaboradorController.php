<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ColaboradorController extends Controller
{
    public function index()
    {
        $colaboradores = Colaborador::all();
        return response()->json($colaboradores);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:100',
            'profissao' => 'required|string|max:50',
            'classificacao' => 'required|string|max:50',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->all();


        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filePath = $file->store('colaboradores', 'public');
            $data['foto'] = $filePath;
        }

        $colaborador = Colaborador::create($data);
        return response()->json($colaborador, 201);
    }

    public function show($id)
    {
        $colaborador = Colaborador::findOrFail($id);
        return response()->json($colaborador);
    }

    public function update(Request $request, string $id)
{
    $colaborador = Colaborador::find($id);

    if ($colaborador) {
        $data = $request->validate([
            'nome' => 'sometimes|required|string|max:100',
            'profissao' => 'sometimes|required|string|max:50',
            'classificacao' => 'sometimes|required|string|max:50',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($colaborador->foto) {
                Storage::disk('public')->delete($colaborador->foto);
            }
            $filePath = $request->file('foto')->store('colaboradores', 'public');
            $data['foto'] = $filePath;
        }

        $colaborador->fill($data);
        $colaborador->save();

        return response()->json([
            'success' => true,
            'message' => 'Colaborador atualizado com sucesso!',
            'colaborador' => $colaborador,
        ]);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Colaborador não encontrado',
        ], 404);
    }
}


    public function destroy($id)
    {
        $colaborador = Colaborador::findOrFail($id);

        if ($colaborador->foto) {
            Storage::disk('public')->delete($colaborador->foto);
        }

        $colaborador->delete();
        return response()->json(null, 204);
    }
}
