<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }
    
    public function login(LoginRequest $request)
    {
        $credentials = $request->getCredentials();
        
        if(!Auth::validate($credentials)) {
            return redirect()->to('login')->withErrors(trans('auth.failed'));
        }
        
        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        Auth::login($user);
        
        return $this->authenticated($request, $user);
    }
    
    protected function authenticated(Request $request, $user)
{
    // Verifica o código de acesso do usuário
    if ($user->key === '987xyz' || $user->key === 'cba321' || $user->key === 'abc123') {
        // Redireciona para a página inicial para os códigos de acesso especificados
        return redirect()->route('home.index');
    } elseif ($user->key === 'aluno2024') {
        // Redireciona para a página de perfil para o código 'aluno2024'
        return redirect()->route('perfil.index');
    } 
}


    
}
