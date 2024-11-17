<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Endereco;
use App\Models\Instituicao;

class EnderecoController extends Controller
{
    public function index($instituicaoId)
    {
        $enderecos = Endereco::where('instituicao_id', $instituicaoId)->get();
        return response()->json($enderecos);
    }

    public function store(Request $request, $instituicaoId)
    {
        $request->validate([
            'local' => 'required|string|max:100',
            'logradouro' => 'required|string|max:150',
            'numero' => 'required|string|max:20',
            'complemento' => 'nullable|string|max:100',
            'bairro' => 'required|string|max:100',
            'cidade' => 'required|string|max:100',
            'estado' => 'required|string|max:2',
            'cep' => 'required|string|max:10',
        ]);

        $endereco = Endereco::create([
            'instituicao_id' => $instituicaoId,
            'local' => $request->local,
            'logradouro' => $request->logradouro,
            'numero' => $request->numero,
            'complemento' => $request->complemento,
            'bairro' => $request->bairro,
            'cidade' => $request->cidade,
            'estado' => $request->estado,
            'cep' => $request->cep,
        ]);

        return response()->json($endereco, 201);
    }

    public function show($instituicaoId, $id)
    {
        $endereco = Endereco::where('instituicao_id', $instituicaoId)->find($id);

        if (!$endereco) {
            return response()->json(['message' => 'Endereço não encontrado'], 404);
        }

        return response()->json($endereco);
    }

    public function update(Request $request, $instituicaoId, $id)
    {
        $endereco = Endereco::where('instituicao_id', $instituicaoId)->find($id);

        if (!$endereco) {
            return response()->json(['message' => 'Endereço não encontrado'], 404);
        }

        $request->validate([
            'local' => 'required|string|max:100',
            'logradouro' => 'required|string|max:150',
            'numero' => 'required|string|max:20',
            'complemento' => 'nullable|string|max:100',
            'bairro' => 'required|string|max:100',
            'cidade' => 'required|string|max:100',
            'estado' => 'required|string|max:2',
            'cep' => 'required|string|max:10',
        ]);

        $endereco->update($request->all());

        return response()->json($endereco);
    }

    public function destroy($instituicaoId, $id)
    {
        $endereco = Endereco::where('instituicao_id', $instituicaoId)->find($id);

        if (!$endereco) {
            return response()->json(['message' => 'Endereço não encontrado'], 404);
        }

        $endereco->delete();

        return response()->json(['message' => 'Endereço deletado com sucesso']);
    }
}
