<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Verifica se o usuário está autenticado e se é admin
        if (!auth()->check() || auth()->user()->access_level !== 'admin') {
            // Redireciona para a página de perfil se o usuário não for admin
            return redirect()->route('perfil.index');
        }

        return $next($request);
    }
}
