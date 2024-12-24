<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class PrivilegeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $privileges): Response
    {
        try {
            // Autenticar al usuario
            $user = JWTAuth::parseToken()->authenticate();

            // Obtener los privilegios desde los perfiles asociados al usuario
            $userPrivileges = $user->profiles()
                ->with('privileges') // Cargar privilegios asociados
                ->get()
                ->pluck('privileges') // Obtener los privilegios de todos los perfiles
                ->flatten() // Aplanar la colección anidada
                ->pluck('name') // Extraer los nombres de los privilegios
                ->toArray();

            // Validar si el usuario tiene al menos uno de los privilegios necesarios
            $hasRequiredPrivilege = array_intersect($privileges, $userPrivileges);

            if (empty($hasRequiredPrivilege)) {
                return response()->json([
                    'error' => 'Unauthorized. At least one of the following privileges is required: ' . implode(', ', $privileges)
                ], 403);
            }

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Unauthorized. ' . $e->getMessage(),
            ], 401);
        }

        return $next($request);
    }
}
