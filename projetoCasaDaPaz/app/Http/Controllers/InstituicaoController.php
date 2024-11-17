<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instituicao;
use App\Models\Endereco;
use App\Models\RedeSocial;

class InstituicaoController extends Controller
{
    public function index()
    {
        $instituicoes = Instituicao::with(['enderecos', 'redesSociais'])->get();
        return response()->json($instituicoes);
    }

    public function store(Request $request)
    {
        $instituicao = Instituicao::create($request->only(['nome', 'cnpj', 'telefone', 'email']));

        if ($request->enderecos) {
            foreach ($request->enderecos as $enderecoData) {
                $instituicao->enderecos()->create($enderecoData);
            }
        }

        if ($request->redes_sociais) {
            foreach ($request->redes_sociais as $redeData) {
                $instituicao->redesSociais()->create($redeData);
            }
        }

        return response()->json($instituicao->load(['enderecos', 'redesSociais']), 201);
    }

    public function show($id)
    {
        $instituicao = Instituicao::with(['enderecos', 'redesSociais'])->find($id);

        if (!$instituicao) {
            return response()->json(['message' => 'Instituição não encontrada'], 404);
        }

        return response()->json($instituicao);
    }

    public function update(Request $request, $id)
    {
        $instituicao = Instituicao::find($id);

        if (!$instituicao) {
            return response()->json(['message' => 'Instituição não encontrada'], 404);
        }

        $instituicao->update($request->only(['nome', 'cnpj', 'telefone', 'email']));

        if ($request->enderecos) {
            $instituicao->enderecos()->delete();
            foreach ($request->enderecos as $enderecoData) {
                $instituicao->enderecos()->create($enderecoData);
            }
        }

        if ($request->redes_sociais) {
            $instituicao->redesSociais()->delete();
            foreach ($request->redes_sociais as $redeData) {
                $instituicao->redesSociais()->create($redeData);
            }
        }

        return response()->json($instituicao->load(['enderecos', 'redesSociais']));
    }

    public function destroy($id)
    {
        $instituicao = Instituicao::find($id);

        if (!$instituicao) {
            return response()->json(['message' => 'Instituição não encontrada'], 404);
        }

        $instituicao->delete();

        return response()->json(['message' => 'Instituição deletada com sucesso']);
    }
}
