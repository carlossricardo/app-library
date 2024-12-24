<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProfileMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $roles ): Response
    {

        try {
            $user = JWTAuth::parseToken()->authenticate();

            // Dividir los roles en un arreglo
            $allowedRoles = explode(',', $roles);

            // Obtener los perfiles del usuario
            $profiles = $user->profiles->pluck('name')->toArray();

            // Verificar si al menos uno de los roles coincide
            if (!array_intersect($allowedRoles, $profiles)) {
                return response()->json(['error' => 'Unauthorized. Roles required: ' . $roles], 403);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }

        return $next($request);

        // try {
            
        //     $user = JWTAuth::parseToken()->authenticate();

        //     $profiles = $user->profiles->pluck('name')->toArray();
        //     if (!in_array($role, $profiles)) {
        //         return response()->json(['error' => 'Unauthorized. Role required: ' . $role], 403);
        //     }
        // }  catch (\Exception $e) {
        //     return response()->json(['error' => $e->getMessage()], 401);
        // }

        // return $next($request);
    }
}
