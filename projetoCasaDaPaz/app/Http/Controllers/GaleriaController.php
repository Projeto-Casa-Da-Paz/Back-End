<?php

namespace App\Http\Controllers;

use App\Models\Galeria;
use Illuminate\Http\Request;

class GaleriaController extends Controller
{

     public function __construct()
     {
         $this->middleware('auth:api');
     }

    public function index()
    {

        $galerias = Galeria::whereNull('deleted_at')->get();
        return response()->json($galerias);
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'nome' => 'required|string|max:100',
            'data' => 'required|date',
            'local' => 'required|string|max:255',
        ]);

        $galeria = Galeria::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Galeria criada com sucesso!',
            'galeria' => $galeria
        ]);
    }

     public function show(string $id)
    {

        $galeria = Galeria::find($id);

        if ($galeria) {
            return response()->json($galeria);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Galeria não encontrada.'
            ], 404);
        }
    }


    public function update(Request $request, string $id)
    {

        $galeria = Galeria::find($id);

        if ($galeria) {

            $data = $request->validate([
                'nome' => 'required|string|max:100',
                'data' => 'required|date',
                'local' => 'required|string|max:255',
            ]);


            $galeria->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Galeria atualizada com sucesso!',
                'galeria' => $galeria
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Galeria não encontrada.'
            ], 404);
        }
    }


    public function destroy(string $id)
    {

        $galeria = Galeria::find($id);

        if ($galeria) {
            $galeria->delete();

            return response()->json([
                'success' => true,
                'message' => 'Galeria excluída com sucesso (soft delete).'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Galeria não encontrada.'
            ], 404);
        }
    }


}
