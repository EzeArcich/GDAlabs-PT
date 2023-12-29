<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\AuthToken;
use App\Models\User;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Log;

class AuthTokenMiddleware
{
    private $authController;

    public function __construct(AuthController $authController)
    {
        $this->authController = $authController;
    }

    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization');

        // Excluída, ya que es la del login
        if ($request->is('api/login')) {
            return $next($request);
        }

        Log::info('Token recibido: ' . $token);

        if (!$token || !$this->isValidToken($token)) {
            Log::info('Token no válido.');

            $token_id = AuthToken::select('user_id')->where('token', $token)->get();
            $token_id = $token_id[0]['user_id'];
            $user = User::where('id', $token_id)->get();

            $newToken = $this->refreshToken($user);
            Log::info('Nuevo Token generado: ' . $newToken);
            $request->headers->set('Authorization', $newToken);

            return $next($request);
        }

        Log::info('Token válido.');

        return $next($request);
    }

    private function isValidToken($token)
    {
        $authToken = AuthToken::where('token', '=', $token)->where('expires_at', '>', now())->first();
        return $authToken !== null;
    }

    private function refreshToken($user)
    {
        $user = $user[0];

        $authToken = AuthToken::where('user_id', $user->id)->first();

        if ($authToken) {
            $token = sha1($user->email . now() . mt_rand(200, 500));

            $authToken->update([
                'token' => $token,
                'expires_at' => now()->addHours(1),
            ]);

            return $token;
        }
    }

    private function getUserFromRequest($email)
    {
        if ($email) {
            return $this->authController->getUserByEmail($email)->first();
        }

        return null;
    }
}
