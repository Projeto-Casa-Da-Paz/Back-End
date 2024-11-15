<?php

namespace App\Http\Controllers;

use App\Models\Voluntario;
use Illuminate\Http\Request;

class VoluntarioController extends Controller
{
    public function index()
    {
        $voluntarios = Voluntario::all();
        return response()->json($voluntarios);
    }

    public function show($id)
    {
        $voluntario = Voluntario::find($id);

        if ($voluntario) {
            return response()->json($voluntario);
        } else {
            return response()->json(['message' => 'Voluntário não encontrado'], 404);
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:100',
            'idade' => 'required|integer',
            'telefone' => 'required|string|max:11',
            'areaAtuacao' => 'required|string|max:100',
            'endereco' => 'required|string|max:255',
        ]);

        $voluntario = Voluntario::create($validatedData);

        return response()->json(['message' => 'Voluntário criado com sucesso', 'voluntario' => $voluntario], 201);
    }

    public function update(Request $request, $id)
    {
        $voluntario = Voluntario::find($id);

        if (!$voluntario) {
            return response()->json(['message' => 'Voluntário não encontrado'], 404);
        }

        $validatedData = $request->validate([
            'nome' => 'sometimes|required|string|max:100',
            'idade' => 'sometimes|required|integer',
            'telefone' => 'sometimes|required|string|max:11',
            'areaAtuacao' => 'sometimes|required|string|max:100',
            'endereco' => 'sometimes|required|string|max:255',
        ]);

        $voluntario->update($validatedData);

        return response()->json(['message' => 'Voluntário atualizado com sucesso', 'voluntario' => $voluntario]);
    }

    public function destroy($id)
    {
        $voluntario = Voluntario::find($id);

        if (!$voluntario) {
            return response()->json(['message' => 'Voluntário não encontrado'], 404);
        }

        $voluntario->delete();

        return response()->json(['message' => 'Voluntário deletado com sucesso']);
    }
}
