<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Solicitacao;

class SolicitacoesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        
        $solicitacoes = Solicitacao::
            where("user_id", $user->id)->orderBy("id")
            ->paginate(10);
        
        return view("solicitacoes.index",
            compact("solicitacoes") );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("solicitacoes.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        
        $storeData = $request->validate(
            [
                "titulo" => "required|max:255",
                "texto" => "required|max:2000",
            ]
        );
        
        $sol = new Solicitacao();
        $sol->titulo = $storeData["titulo"];
        $sol->texto = $storeData["texto"];
        $sol->status = "ABERTO";
        $sol->data = date("Y-m-d H:i:s");
        $sol->user_id = $user->id;
        
        // insert na tabela
        $sol->save();
        
        return redirect()->route('solicitacoes.index')->withSuccess(__('Solicitação criada com sucesso.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $solicitacao = Solicitacao::findOrFail($id);
        return view('solicitacoes.show', ['solicitacao' => $solicitacao]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $solicitacao = Solicitacao::findOrFail($id);
        return view('solicitacoes.edit', ['solicitacao' => $solicitacao]);
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
            'titulo' => 'required|max:255',
            'texto' => 'required|max:2000',
        ]);
        
        // update tb_solicitacoes (titulo, texto)
        //    values ('asdf', 'asdfas') where id = 2;
        Solicitacao::whereId($id)->update($storeData);
        return redirect('/solicitacoes')->with('completed', 'Solicitação atualizada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $solicitacao = Solicitacao::findOrFail($id);
        $solicitacao->delete();
        return redirect('/solicitacoes')->with('completed', 'Solicitação removida com sucesso');
    }
}
