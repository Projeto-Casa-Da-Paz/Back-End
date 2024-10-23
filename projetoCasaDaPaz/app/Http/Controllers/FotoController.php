<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use Illuminate\Http\Request;

class FotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   /* public function __construct()
    {
        $this->middleware('auth:api');//acesso apenas com o login
    }
*/
    public function index($galeriaId)
    {

        $fotos = Foto::where('id_galeria', $galeriaId)->get();

        return response()->json($fotos);
    }

    public function store(Request $request, $galeriaId)
    {

        $data = $request->validate([
            'descricao' => 'nullable|string|max:255',
            'nome' => 'required|string|max:255',
        ]);

        $foto = Foto::create([
            'id_galeria' => $galeriaId,
            'descricao' => $data['descricao'],
            'nome' => $data['nome'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Foto criada com sucesso!',
            'foto' => $foto
        ]);
    }


    public function show($galeriaId, $id)
    {

        $foto = Foto::where('id_galeria', $galeriaId)->find($id);

        if ($foto) {
            return response()->json($foto);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Foto não encontrada'
            ], 404);
        }
    }


    public function update(Request $request, $galeriaId, $id)
    {

        $foto = Foto::where('id_galeria', $galeriaId)->find($id);

        if ($foto) {

            $data = $request->validate([
                'descricao' => 'nullable|string|max:255',
                'nome' => 'required|string|max:255',
            ]);

            $foto->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Foto atualizada com sucesso!',
                'foto' => $foto
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Foto não encontrada'
            ], 404);
        }
    }


    public function destroy($galeriaId, $id)
    {
        $foto = Foto::where('id_galeria', $galeriaId)->find($id);

        if ($foto) {
            $foto->delete();

            return response()->json([
                'success' => true,
                'message' => 'Foto excluída com sucesso.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Foto não encontrada'
            ], 404);
        }
    }
}
