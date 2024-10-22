<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        return response()->json($usuarios);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:usuarios',
            'perfil' => 'required|string|max:100',
            'senha' => 'required|string|max:100',
        ]);

        $usuario = Usuario::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'perfil' => $request->perfil,
            'senha' => bcrypt($request->senha),
        ]);

        return response()->json($usuario, 201);
    }

    public function show($id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        return response()->json($usuario);
    }


    public function update(Request $request, $id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        $usuario->update($request->only(['nome', 'email', 'perfil', 'senha']));

        return response()->json($usuario);
    }


    public function destroy($id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        $usuario->delete();

        return response()->json(['message' => 'Usuário deletado com sucesso']);
    }
}
