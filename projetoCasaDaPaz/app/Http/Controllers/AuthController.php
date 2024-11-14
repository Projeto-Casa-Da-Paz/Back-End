<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios',
            'password' => 'required|string|min:6|confirmed',
            'perfil' => 'required|string|max:100',
        ]);

        $user = Usuario::create([
            'nome' => $validatedData['nome'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'perfil' => $validatedData['perfil'],
        ]);

        $token = Auth::login($user);

        return response()->json([
            'access_token' => $token,
            'user' => $user, // Retorna os dados completos do usuário
        ]);
    }

    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (! $token = Auth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'access_token' => $token,
            'user' => Auth::user(), // Retorna os dados completos do usuário autenticado
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function me()
    {
        return response()->json([
            'user' => Auth::user(), // Retorna os dados completos do usuário
        ]);
    }
}
