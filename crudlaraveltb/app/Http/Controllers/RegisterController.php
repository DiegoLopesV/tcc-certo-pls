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

    public function register(Request $request)
    {
        // Validação inicial da chave
        $validKeys = ['987xyz', 'abc123'];
        $keyEndsWith4or5 = in_array(substr($request->key, -1), ['4', '5']);
        $keyEndsWith2or3 = in_array(substr($request->key, -1), ['2', '3']);
        $keyEndsWith6or7 = in_array(substr($request->key, -1), ['6', '7']);
        $keyEndsWith0or1 = in_array(substr($request->key, -1), ['0', '1']);
        $keyEndsWith8or9 = in_array(substr($request->key, -1), ['8', '9']); // Alunos

        if (!in_array($request->key, $validKeys) && !$keyEndsWith4or5 && !$keyEndsWith2or3 && !$keyEndsWith6or7 && !$keyEndsWith0or1 && !$keyEndsWith8or9) {
            return back()->withErrors(['key' => 'Chave inválida.']);
        }

        // Busca chave temporária, se existir
        $chaveTemporaria = ChaveTemporaria::where('nome', $request->nome)->first();
        $keyToUse = $chaveTemporaria ? $chaveTemporaria->chave : $request->key;

        // Cria o usuário na tabela 'users'
        $user = User::create($request->all() + ['role' => 'ROLE_USER', 'key' => $keyToUse]);
        auth()->login($user);

        // Valida imagem (se enviada no registro)
        $foto = null;
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $image = $request->file('foto');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('assets/img');
            $image->move($destinationPath, $imageName);
            $foto = 'assets/img/' . $imageName;
        }

        // Criação de registros nas tabelas específicas
        if ($keyEndsWith8or9) { // Alunos
            Aluno::create([
                'nome' => $user->nome,
                'email' => $user->email,
                'cpf' => $request->cpf,
                'telefone' => $request->telefone,
                'data_nascimento' => $request->data_nascimento,
                'foto' => $foto,
                'chave' => $keyToUse,
            ]);
        } elseif ($keyEndsWith4or5) {
            Professor::create([
                'nome' => $user->nome,
                'email' => $user->email,
                'cpf' => $request->cpf,
                'telefone' => $request->telefone,
                'numeroDeContrato' => $request->numeroDeContrato,
                'data_nascimento' => $request->data_nascimento,
                'foto' => $foto,
                'chave' => $keyToUse,
            ]);
        } elseif ($keyEndsWith2or3) {
            Terceirizados::create([
                'nome' => $user->nome,
                'email' => $user->email,
                'cpf' => $request->cpf,
                'telefone' => $request->telefone,
                'numeroDeContrato' => $request->numeroDeContrato,
                'data_nascimento' => $request->data_nascimento,
                'foto' => $foto,
                'chave' => $keyToUse,
            ]);
        } elseif ($keyEndsWith6or7) {
            Enfermeiros::create([
                'nome' => $user->nome,
                'email' => $user->email,
                'cpf' => $request->cpf,
                'telefone' => $request->telefone,
                'numeroDeContrato' => $request->numeroDeContrato,
                'data_nascimento' => $request->data_nascimento,
                'foto' => $foto,
                'chave' => $keyToUse,
            ]);
        } elseif ($keyEndsWith0or1 || $request->key === '987xyz') { // Administradores
            Administradores::create([
                'nome' => $user->nome,
                'email' => $user->email,
                'cpf' => $request->cpf,
                'telefone' => $request->telefone,
                'numeroDeContrato' => $request->numeroDeContrato,
                'data_nascimento' => $request->data_nascimento,
                'foto' => $foto,
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

