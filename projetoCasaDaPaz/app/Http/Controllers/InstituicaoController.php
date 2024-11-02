<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instituicao;
use App\Models\Endereco;
use App\Models\RedeSocial;

class InstituicaoController extends Controller
{
    // Lista todas as instituições
    public function index()
    {
        $instituicoes = Instituicao::with(['enderecos', 'redesSociais'])->get();
        return response()->json($instituicoes);
    }

    // Armazena uma nova instituição com endereços e redes sociais
    public function store(Request $request)
    {
        $instituicao = Instituicao::create($request->only(['nome', 'cnpj', 'telefone', 'email']));

        // Adiciona endereços, se houver
        if ($request->enderecos) {
            foreach ($request->enderecos as $enderecoData) {
                $instituicao->enderecos()->create($enderecoData);
            }
        }

        // Adiciona redes sociais, se houver
        if ($request->redes_sociais) {
            foreach ($request->redes_sociais as $redeData) {
                $instituicao->redesSociais()->create($redeData);
            }
        }

        return response()->json($instituicao->load(['enderecos', 'redesSociais']), 201);
    }

    // Mostra uma instituição específica com seus endereços e redes sociais
    public function show($id)
    {
        $instituicao = Instituicao::with(['enderecos', 'redesSociais'])->find($id);

        if (!$instituicao) {
            return response()->json(['message' => 'Instituição não encontrada'], 404);
        }

        return response()->json($instituicao);
    }

    // Atualiza uma instituição, incluindo endereços e redes sociais
    public function update(Request $request, $id)
    {
        $instituicao = Instituicao::find($id);

        if (!$instituicao) {
            return response()->json(['message' => 'Instituição não encontrada'], 404);
        }

        $instituicao->update($request->only(['nome', 'cnpj', 'telefone', 'email']));

        // Atualiza endereços, se houver
        if ($request->enderecos) {
            $instituicao->enderecos()->delete(); // Remove endereços antigos
            foreach ($request->enderecos as $enderecoData) {
                $instituicao->enderecos()->create($enderecoData);
            }
        }

        // Atualiza redes sociais, se houver
        if ($request->redes_sociais) {
            $instituicao->redesSociais()->delete(); // Remove redes antigas
            foreach ($request->redes_sociais as $redeData) {
                $instituicao->redesSociais()->create($redeData);
            }
        }

        return response()->json($instituicao->load(['enderecos', 'redesSociais']));
    }

    // Remove uma instituição e seus relacionamentos
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
