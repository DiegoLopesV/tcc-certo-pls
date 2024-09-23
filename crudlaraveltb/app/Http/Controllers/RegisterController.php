<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }
    
    public function register(RegisterRequest $request)
{
    // Cria o usuário
    $user = User::create($request->all() + ['role' => 'ROLE_USER']);

    // Faz login do usuário
    auth()->login($user);

    // Redireciona com base na chave
    if ($user->key === '987xyz' || $user->key === 'cba321' || $user->key === 'abc123') {
        return redirect()->route('home.index')->with('success', "Cadastro efetuado com sucesso");
    } elseif ($user->key === 'aluno2024') {
        return redirect()->route('perfil.index')->with('success', "Cadastro efetuado com sucesso");
    }

    // Redireciona para uma página padrão se a chave não corresponder
    return redirect()->route('home.index')->with('success', "Cadastro efetuado com sucesso");
}




    
    
}
