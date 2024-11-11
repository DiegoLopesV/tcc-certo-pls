<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Endereco;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy("id", "desc")->paginate(10);
        return view("usuarios.index", compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("usuarios.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    


    public function store(Request $request)
    {
        $storeData = $request->validate([
            'nome' => 'required|max:255',
            'email' => 'required|email|max:255|unique:alunos,email',
            'password' => 'required|max:255',
            'cpf' => 'required|unique:alunos,cpf',
        ],[
                'email.unique' => 'O e-mail informado já está em uso. Por favor, utilize outro.',
                'cpf.unique' => 'O CPF informado já está cadastrado.',
                // Você pode adicionar mensagens personalizadas para outros campos também
            ]);
        
        $dados = array_merge($storeData, ["role" => "ROLE_USER"]);
        
        $endereco = new Endereco();
        $endereco->cep = $request["cep"];
        $endereco->logradouro = $request["logradouro"];
        $endereco->numero = $request["numero"];
        
        // Insert na tabela user
        $usuario = User::create($dados);
        
        // insert na tb endereco
        $usuario->endereco()->save($endereco);
        
        return redirect()->route('usuarios.index')
            ->withSuccess(__('Usuário criado com sucesso.'));
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view("usuarios.show", compact("user"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view("usuarios.edit", compact("user"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $storeData = $request->validate([
            'nome' => 'required|max:255',
            'email' => 'required|max:255'
        ]);
        
        $endereco = User::find($id)->endereco;
        $endereco->cep = $request["cep"];
        $endereco->logradouro = $request["logradouro"];
        $endereco->numero = $request["numero"];

        // Procurando o ID do usuário e atualizando na base de dados
        User::whereId($id)->update($storeData);

        // Dando update na 'tb_enderecos'
        $endereco->update();

        
        

        return redirect()->route('usuarios.index')->withSuccess(__('Usuário atualizado com sucesso.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('/usuarios')->with('completed', 'Usuário removido com sucesso');
    }
}
