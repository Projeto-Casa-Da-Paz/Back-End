<?php

namespace App\Http\Controllers;

use App\Models\Instituicao;
use Illuminate\Http\Request;

class InstituicaoController extends Controller
{


     public function __construct()
     {
         $this->middleware('auth:api');
     }


    public function index()
    {

        $instituicoes = Instituicao::where('ativo', true)->get();
        return response()->json($instituicoes);
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:100',
            'telefone' => 'nullable|string|max:100',
            'instagram' => 'nullable|string|max:100',
            'instagram_bazar' => 'nullable|string|max:100',
            'fanpage' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:100',
            'end_bazar' => 'nullable|string|max:255',
            'end_sede' => 'nullable|string|max:255',
        ]);


        $instituicao = Instituicao::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Instituição criada com sucesso!',
            'instituicao' => $instituicao
        ]);
    }

    public function show(string $id)
    {
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

    public function update(Request $request, string $id)
    {

        $instituicao = Instituicao::find($id);

        if ($instituicao) {

            $data = $request->validate([
                'nome' => 'required|string|max:100',
                'telefone' => 'nullable|string|max:100',
                'instagram' => 'nullable|string|max:100',
                'instagram_bazar' => 'nullable|string|max:100',
                'fanpage' => 'nullable|string|max:100',
                'email' => 'nullable|email|max:100',
                'end_bazar' => 'nullable|string|max:255',
                'end_sede' => 'nullable|string|max:255',
            ]);

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

    public function destroy(string $id)
    {

        $instituicao = Instituicao::find($id);

        if ($instituicao) {
            $instituicao->delete();

            return response()->json(['message' => 'Instituição excluída com sucesso.']);
        } else {
            return response()->json(['message' => 'Instituição não encontrada.'], 404);
        }
    }

}
