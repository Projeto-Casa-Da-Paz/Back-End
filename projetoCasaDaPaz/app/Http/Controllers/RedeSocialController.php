<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RedeSocial;

class RedeSocialController extends Controller
{
    public function index($instituicaoId)
    {
        $redes = RedeSocial::where('instituicao_id', $instituicaoId)->get();
        return response()->json($redes);
    }

    public function store(Request $request, $instituicaoId)
    {
        $request->validate([
            'nome' => 'required|string|max:100',
            'tipo' => 'required|string|max:100',
            'url' => 'required|string|max:255',
        ]);

        $rede = RedeSocial::create([
            'instituicao_id' => $instituicaoId,
            'nome' => $request->nome,
            'tipo' => $request->tipo,
            'url' => $request->url,
        ]);

        return response()->json($rede, 201);
    }


    public function show($instituicaoId, $id)
    {
        $rede = RedeSocial::where('instituicao_id', $instituicaoId)->find($id);

        if (!$rede) {
            return response()->json(['message' => 'Rede social não encontrada'], 404);
        }

        return response()->json($rede);
    }

    public function update(Request $request, $instituicaoId, $id)
    {
        $rede = RedeSocial::where('instituicao_id', $instituicaoId)->find($id);

        if (!$rede) {
            return response()->json(['message' => 'Rede social não encontrada'], 404);
        }

        $request->validate([
            'nome' => 'required|string|max:100',
            'tipo' => 'required|string|max:100',
            'url' => 'required|string|max:255',
        ]);

        $rede->update($request->all());

        return response()->json($rede);
    }

    public function destroy($instituicaoId, $id)
    {
        $rede = RedeSocial::where('instituicao_id', $instituicaoId)->find($id);

        if (!$rede) {
            return response()->json(['message' => 'Rede social não encontrada'], 404);
        }

        $rede->delete();

        return response()->json(['message' => 'Rede social deletada com sucesso']);
    }
}
