<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\Professor;
use App\Models\Enfermeiros;
use App\Models\Terceirizados;
use App\Models\Administradores;
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
        // Validação inicial da chave
        $validKeys = ['987xyz', 'abc123'];
        $keyEndsWith4or5 = in_array(substr($request->key, -1), ['4', '5']);
        $keyEndsWith2or3 = in_array(substr($request->key, -1), ['2', '3']);
        $keyEndsWith6or7 = in_array(substr($request->key, -1), ['6', '7']);
        $keyEndsWith0or1 = in_array(substr($request->key, -1), ['0', '1']);
    
        if (!in_array($request->key, $validKeys) && !$keyEndsWith4or5 && !$keyEndsWith2or3 && !$keyEndsWith6or7 && !$keyEndsWith0or1) {
            return back()->withErrors(['key' => 'Chave inválida.']);
        }
    
        // Busca chave temporária, se existir
        $chaveTemporaria = ChaveTemporaria::where('nome', $request->nome)->first();
        $keyToUse = $chaveTemporaria ? $chaveTemporaria->chave : $request->key;
    
        // Cria o usuário
        $user = User::create($request->all() + ['role' => 'ROLE_USER', 'key' => $keyToUse]);
        auth()->login($user);
    
        // Valida imagem
        $validatedData = [];
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $image = $request->file('foto');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('assets/img');
            $image->move($destinationPath, $imageName);
            $validatedData['foto'] = 'assets/img/' . $imageName;
        } else {
            $validatedData['foto'] = null;
        }
    
        // Criar Professor
        if ($keyEndsWith4or5) {
            Professor::create([
                'nome' => $user->nome,
                'email' => $user->email,
                'cpf' => $request->cpf,
                'telefone' => $request->telefone,
                'numeroDeContrato' => $request->numeroDeContrato,
                'data_nascimento' => $request->data_nascimento,
                'foto' => $validatedData['foto'],
                'chave' => $keyToUse,
            ]);
        }
    
        // Criar Terceirizado
        if ($keyEndsWith2or3) {
            Terceirizados::create([
                'nome' => $user->nome,
                'email' => $user->email,
                'cpf' => $request->cpf,
                'telefone' => $request->telefone,
                'numeroDeContrato' => $request->numeroDeContrato,
                'data_nascimento' => $request->data_nascimento,
                'foto' => $validatedData['foto'],
                'chave' => $keyToUse,
            ]);
        }
    
        // Criar Enfermeiro
        if ($keyEndsWith6or7) {
            Enfermeiros::create([
                'nome' => $user->nome,
                'email' => $user->email,
                'cpf' => $request->cpf,
                'telefone' => $request->telefone,
                'numeroDeContrato' => $request->numeroDeContrato,
                'data_nascimento' => $request->data_nascimento,
                'foto' => $validatedData['foto'],
                'chave' => $keyToUse,
            ]);
        }
    
        // Criar Administrador
        if ($keyEndsWith0or1) {
            Administradores::create([
                'nome' => $user->nome,
                'email' => $user->email,
                'cpf' => $request->cpf,
                'telefone' => $request->telefone,
                'numeroDeContrato' => $request->numeroDeContrato,
                'data_nascimento' => $request->data_nascimento,
                'foto' => $validatedData['foto'],
                'chave' => $keyToUse,
            ]);
        }
    
        // Remove chave temporária após uso
        if ($chaveTemporaria) {
            $chaveTemporaria->delete();
        }
    
        // Redireciona após o registro
        return redirect()->route('home.index')->with('success', "Cadastro efetuado com sucesso");
    }
    

    
    

    
}

