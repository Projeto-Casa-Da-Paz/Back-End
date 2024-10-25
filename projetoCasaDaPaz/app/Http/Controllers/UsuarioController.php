<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Http\Resources\UsuarioResource; // Certifique-se de criar o recurso
use Illuminate\Validation\ValidationException;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        return UsuarioResource::collection($usuarios);
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);

        $usuario = Usuario::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'perfil' => $request->perfil,
            'senha' => bcrypt($request->senha),
        ]);

        return new UsuarioResource($usuario, 201);
    }

    public function show($id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        return new UsuarioResource($usuario);
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        $this->validateRequest($request, $usuario->id);

        $usuario->update($request->only(['nome', 'email', 'perfil', 'senha']));

        return new UsuarioResource($usuario);
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

    private function validateRequest(Request $request, $userId = null)
    {
        $rules = [
            'nome' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:usuarios' . ($userId ? ",email,{$userId}" : ''),
            'perfil' => 'required|string|max:100',
            'senha' => 'required|string|max:100',
        ];

        return $request->validate($rules);
    }
}
