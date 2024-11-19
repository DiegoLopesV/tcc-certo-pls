<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Professor;
use App\Models\Terceirizados;
use App\Models\Enfermeiros;
use App\Models\Administradores;
use Illuminate\Support\Facades\Log;

class CheckUserKey
{
    /**
     * Manipula a requisição.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$keys  Parâmetros de chave autorizadas
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$keys)
    {
        // Verifica se o usuário está autenticado
        if ($request->user()) {
            $userKey = $request->user()->key;
            Log::info('Middleware chamado para a chave: ', ['key' => $userKey]);

            // Verifica se a chave do usuário está diretamente nas chaves autorizadas
            if (in_array($userKey, $keys)) {
                return $next($request);
            }

            // Verifica se a chave do usuário está na tabela `professors`
            $professor = Professor::where('chave', $userKey)->first();  // Busca a chave diretamente
            if ($professor) {
                return $next($request);
            }

            // Verifica se a chave do usuário está na tabela `professors`
            $terceirizados = Terceirizados::where('chave', $userKey)->first();  // Busca a chave diretamente
            if ($terceirizados) {
                return $next($request);
            }

            // Verifica se a chave do usuário está na tabela `professors`
            $enfermeiros = Enfermeiros::where('chave', $userKey)->first();  // Busca a chave diretamente
            if ($enfermeiros) {
                return $next($request);
            }

            // Verifica se a chave do usuário está na tabela `professors`
            $enfermeiros = Enfermeiros::where('chave', $userKey)->first();  // Busca a chave diretamente
            if ($enfermeiros) {
                return $next($request);
            }

            // Verifica se a chave do usuário está na tabela `professors`
            $administradores = Administradores::where('chave', $userKey)->first();  // Busca a chave diretamente
            if ($administradores) {
                return $next($request);
            }
        }

        // Redireciona ou retorna um erro se a chave não for autorizada
        return redirect('/')->withErrors('Acesso negado: chave de usuário inválida.');
    }
}



