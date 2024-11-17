<?php

namespace App\Http\Controllers;

use App\Models\Doacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DoacaoController extends Controller
{
    public function index()
    {
        $doacoes = Doacao::all();
        return response()->json($doacoes);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'banco' => 'required|string|max:50',
            'agencia' => 'required|string|max:10',
            'conta_corrente' => 'required|string|max:20',
            'cnpj' => 'required|string|size:18|regex:/\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}/',
            'titular' => 'required|string|max:100',
            'chave_pix' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $doacao = Doacao::create($request->all());
        return response()->json($doacao, 201);
    }

    public function show($id)
    {
        $doacao = Doacao::findOrFail($id);
        return response()->json($doacao);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'banco' => 'sometimes|required|string|max:50',
            'agencia' => 'sometimes|required|string|max:10',
            'conta_corrente' => 'sometimes|required|string|max:20',
            'cnpj' => 'sometimes|required|string|size:18|regex:/\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}/',
            'titular' => 'sometimes|required|string|max:100',
            'chave_pix' => 'sometimes|required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $doacao = Doacao::findOrFail($id);
        $doacao->update($request->all());
        return response()->json($doacao);
    }

    public function destroy($id)
    {
        $doacao = Doacao::findOrFail($id);
        $doacao->delete();
        return response()->json(null, 204);
    }
}
