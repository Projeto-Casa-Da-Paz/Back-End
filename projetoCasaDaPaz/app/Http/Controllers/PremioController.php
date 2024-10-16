<?php

namespace App\Http\Controllers;

use App\Models\Premio;
use Illuminate\Http\Request;

class PremioController extends Controller
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
        //
        $premios = Premio::all();

        return response()->json($premios);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'nome' => 'required|string|max:100',
            'categoria' => 'nullable|string|max:100',
            'data_recebimento' => 'nullable|date',
            'imagem' => 'nullable|string|max:100',

        ]);

        // Criar um novo prêmio
        $premio = Premio::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Prêmio criado com sucesso!',
            'premio' => $premio
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $premio = Premio::find($id);

        if ($premio) {
            return response()->json($premio);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Prêmio não encontrado'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $premio = Premio::find($id);

        if ($premio) {
            $data = $request->validate([
                'nome' => 'required|string|max:100',
                'categoria' => 'nullable|string|max:100',
                'data_recebimento' => 'nullable|date',
                'imagem' => 'nullable|string|max:100',
            ]);

            $premio->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Prêmio atualizado com sucesso!',
                'premio' => $premio
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Prêmio não encontrado'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) //inativar
    {
        //
        $premio = Premio::find($id);

        if ($premio) {
            $premio->delete();

            return response()->json([
                'success' => true,
                'message' => 'Prêmio deletado com sucesso!'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Prêmio não encontrado'
            ], 404);
        }
    }

}
