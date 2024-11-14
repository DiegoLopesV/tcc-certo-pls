<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\Professor;
use Illuminate\Support\Facades\Log;
use App\Models\ChaveTemporaria;
use Illuminate\Support\Facades\Crypt;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
{
    // Verifica se a chave é válida
    $validKeys = ['987xyz', 'abc123'];
    $keyEndsWith4or5 = in_array(substr($request->key, -1), ['4', '5']);
    
    // Verifica se a chave não é válida
    if (!in_array($request->key, $validKeys) && !$keyEndsWith4or5) {
        return back()->withErrors(['key' => 'Chave inválida.']);
    }
    
    // Busca a chave temporária associada ao nome do professor
    $chaveTemporaria = ChaveTemporaria::where('nome', $request->nome)->first();
    
    $keyToUse = $chaveTemporaria ? $chaveTemporaria->chave : $request->key;
    
    // Cria o usuário com a chave determinada
    $user = User::create($request->all() + ['role' => 'ROLE_USER', 'key' => $keyToUse]);
    
    // Faz login do usuário
    auth()->login($user);
    
    // Criação do professor caso a chave termine em 4 ou 5
    if ($chaveTemporaria && in_array(substr($chaveTemporaria->chave, -1), ['4', '5'])) {
        $validatedData = [];
        
        // Verifica se o arquivo de imagem foi enviado
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $image = $request->file('foto');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('assets/img');
            $image->move($destinationPath, $imageName);
            $validatedData['foto'] = 'assets/img/' . $imageName;
        } else {
            $validatedData['foto'] = null;
        }
        
        // Criação do professor
        Professor::create([
            'nome' => $user->nome,
            'email' => $user->email,
            'cpf' => $request->cpf,
            'telefone' => $request->telefone,
            'data_nascimento' => $request->data_nascimento,
            'foto' => $validatedData['foto'],
            'chave' => $chaveTemporaria->chave,
        ]);
        
        // Remove a chave temporária após o uso
        $chaveTemporaria->delete();
    } else {
        return redirect()->back()->withErrors("Chave não encontrada ou não válida para o nome fornecido.");
    }
    
    // Redireciona com base na chave do usuário
    if (in_array($user->key, ['987xyz', 'abc123']) || $keyEndsWith4or5) {
        return redirect()->route('home.index')->with('success', "Cadastro efetuado com sucesso");
    } elseif ($user->key === 'aluno2024') {
        return redirect()->route('perfil.index')->with('success', "Cadastro efetuado com sucesso");
    }
}

    
    

    
}

