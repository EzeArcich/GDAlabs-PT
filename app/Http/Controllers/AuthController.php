<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\AuthToken;

class AuthController extends Controller
{
    
    public function getUserByEmail($email)
    {

        $usuario = User::where('email', $email)->first();
        Log::info("getUserByEmail: Buscando usuario por email: $email");
        return $usuario;

    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
    
        if (!$user) {
            Log::info("login: Usuario no encontrado para email: " . $request->email);
            return response()->json(['success' => false, 'message' => 'Usuario no encontrado'], 404);
        }
    
        if ($request->password == $user->password) {
            $token = $this->generateToken($user);
            Log::info("login: Generado token para usuario con email: " . $user->email);
            return response()->json(['token' => $token, 'success' => true]);
        }
    
        Log::info("login: Contraseña incorrecta para usuario con email: " . $user->email);
        return response()->json(['success' => false, 'message' => 'Contraseña incorrecta'], 401);
    }
    

    public function generateToken(User $user)
    {

        $token = sha1($user->email . now() . mt_rand(200, 500));

        AuthToken::create([
            'user_id' => $user->id,
            'token' => $token,
            'expires_at' => now()->addHours(1),
        ]);

        Log::info("generateToken: Generado token para usuario con email: " . $user->email);
        return $token;
    }
}
