<?php

namespace App\Http\Controllers;

use App\Models\Instituicao;
use Illuminate\Http\Request;

class InstituicaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct()
     {
         $this->middleware('auth:api');//acesso apenas com o login
     }


    public function index()
    {
        // Retorna todas as instituições ativas
        $instituicoes = Instituicao::where('ativo', true)->get();
        return response()->json($instituicoes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:100',
            'telefone' => 'nullable|string|max:100',
            'instagram' => 'nullable|string|max:100',
            'instagram_bazar' => 'nullable|string|max:100',
            'fanpage' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:100',
            'end_bazar' => 'nullable|string|max:100',
            'end_sede' => 'nullable|string|max:100',
        ]);

        // Criar uma nova instituição
        $instituicao = Instituicao::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Instituição criada com sucesso!',
            'instituicao' => $instituicao
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Encontrar a instituição sem soft deletes
        $instituicao = Instituicao::find($id);

        if ($instituicao) {
            return response()->json($instituicao);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Instituição não encontrada'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Encontrar a instituição sem soft deletes
        $instituicao = Instituicao::find($id);

        if ($instituicao) {
            // Validar os dados atualizados
            $data = $request->validate([
                'nome' => 'required|string|max:100',
                'telefone' => 'nullable|string|max:100',
                'instagram' => 'nullable|string|max:100',
                'instagram_bazar' => 'nullable|string|max:100',
                'fanpage' => 'nullable|string|max:100',
                'email' => 'nullable|email|max:100',
                'end_bazar' => 'nullable|string|max:100',
                'end_sede' => 'nullable|string|max:100',
            ]);

            // Atualizar os dados da instituição
            $instituicao->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Instituição atualizada com sucesso!',
                'instituicao' => $instituicao
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Instituição não encontrada'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Excluir a instituição
        $instituicao = Instituicao::find($id);

        if ($instituicao) {
            $instituicao->delete();

            return response()->json(['message' => 'Instituição excluída com sucesso.']);
        } else {
            return response()->json(['message' => 'Instituição não encontrada.'], 404);
        }
    }

    public function deactivate(string $id)
    {
        $instituicao = Instituicao::find($id);

        if ($instituicao) {
            $instituicao->ativo = false;
            $instituicao->save();

            return response()->json(['message' => 'Instituição desativada com sucesso.']);
        } else {
            return response()->json(['message' => 'Instituição não encontrada.'], 404);
        }
    }
}
