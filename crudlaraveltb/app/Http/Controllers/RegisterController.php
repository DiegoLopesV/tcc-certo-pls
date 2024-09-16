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
    // Cria o usuário com os dados do formulário
    $user = User::create(array_merge($request->validated(), ['role' => 'ROLE_USER']));
    
    // Faz login do usuário
    auth()->login($user);

    // Verifica a chave do usuário para decidir o redirecionamento
    switch ($user->key) {
        case '987xyz':
        case 'cba321':
        case 'abc123':
            // Redireciona para a página inicial para usuários com chaves específicas
            return redirect()->route('home.index')->with('success', "Cadastro efetuado com sucesso");
        
        case 'aluno2024':
            // Redireciona para a página de perfil para usuários com a chave 'aluno2024'
            return redirect()->route('perfil.index')->with('success', "Cadastro efetuado com sucesso");
        
        default:
            // Redireciona para a página inicial padrão se a chave não corresponder a nenhum dos casos acima
            return redirect('/')->with('success', "Cadastro efetuado com sucesso");
    }
}

    
    
}
