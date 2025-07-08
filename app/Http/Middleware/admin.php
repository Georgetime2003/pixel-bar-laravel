<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Necessites iniciar sessió per accedir a aquesta pàgina.');
        }

        // Verificar si el usuario es admin
        if (!Auth::user()->is_admin) {
            abort(403, 'No tens permisos per accedir a aquesta pàgina.');
        }

        return $next($request);
    }
}
