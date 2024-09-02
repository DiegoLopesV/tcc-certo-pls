<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alunos;

class AlunosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // select * from tb_alunos order by id desc limit 10
        $alunos = ALunos::all();
        return view('alunos.index', compact('alunos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("alunos.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $aluno = new Alunos();
        $aluno->nome = $request->nome;
        $aluno->curso = $request->curso;
        $aluno->turma = $request->turma;
        $aluno->cpf = $request->cpf;
        $aluno->nome_pais = $request->nome_pais;
        $aluno->telefone = $request->telefone;
        $aluno->telefone_pais = $request->telefone_pais;
        $aluno->email = $request->email;
        $aluno->email_pais = $request->email_pais;

        $aluno->save();

        return response()->json(['message' => 'Aluno salvo com sucesso!', 'id' => $aluno->id]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $alunos = Alunos::findOrFail($id);
        return view("alunos.show", compact("alunos"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $alunos = Alunos::findOrFail($id);
        return response()->json($alunos);
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
        $aluno = Alunos::findOrFail($id);
        $aluno->nome = $request->nome;
        $aluno->curso = $request->curso;
        $aluno->turma = $request->turma;
        $aluno->cpf = $request->cpf;
        $aluno->nome_pais = $request->nome_pais;
        $aluno->telefone = $request->telefone;
        $aluno->telefone_pais = $request->telefone_pais;
        $aluno->email = $request->email;
        $aluno->email_pais = $request->email_pais;

        $aluno->save();

        return response()->json(['message' => 'Aluno atualizado com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd($id);
        $alunos = Alunos::findOrFail($id);
        $alunos->delete();
        return response()->json(['message' => 'Aluno excluído com sucesso!']);
    }

    // método no controlador para retornar apenas alunos da turma Info 1
    public function showInfo1()
    {
        $alunos = Alunos::where('turma', 'Info 1')->get();
        return view('layouts.partials.info1', compact('alunos'));
    }

    // método no controlador para retornar apenas alunos da turma Info 1
    public function showInfo2()
    {
        $alunos = Alunos::where('turma', 'Info 2')->get();
        return view('layouts.partials.info2', compact('alunos'));
    }

    // método no controlador para retornar apenas alunos da turma Info 1
    public function showInfo3()
    {
        $alunos = Alunos::where('turma', 'Info 3')->get();
        return view('layouts.partials.info3', compact('alunos'));
    }

    public function showInfo4()
    {
        $alunos = Alunos::where('turma', 'Info 4')->get();
        return view('layouts.partials.info4', compact('alunos'));
    }

    public function showPg1()
    {
        $alunos = Alunos::where('turma', 'PG 1')->get();
        return view('layouts.partials.pg1', compact('alunos'));
    }
    public function showPg2()
    {
        $alunos = Alunos::where('turma', 'PG 2')->get();
        return view('layouts.partials.pg2', compact('alunos'));
    }
    public function showPg3()
    {
        $alunos = Alunos::where('turma', 'PG 3')->get();
        return view('layouts.partials.pg3', compact('alunos'));
    }

    public function showAdm1()
    {
        $alunos = Alunos::where('turma', 'Adm 1')->get();
        return view('layouts.partials.adm1', compact('alunos'));
    }

    public function showAdm2()
    {
        $alunos = Alunos::where('turma', 'Adm 2')->get();
        return view('layouts.partials.adm2', compact('alunos'));
    }

    public function showAdm3()
    {
        $alunos = Alunos::where('turma', 'Adm 3')->get();
        return view('layouts.partials.adm3', compact('alunos'));
    }

    public function showElet1()
    {
        $alunos = Alunos::where('turma', 'Eletrônica 1')->get();
        return view('layouts.partials.elet1', compact('alunos'));
    }

    public function showElet2()
    {
        $alunos = Alunos::where('turma', 'Eletrônica 2')->get();
        return view('layouts.partials.elet2', compact('alunos'));
    }

    public function showElet3()
    {
        $alunos = Alunos::where('turma', 'Eletrônica 3')->get();
        return view('layouts.partials.elet3', compact('alunos'));
    }

    public function showMec1()
    {
        $alunos = Alunos::where('turma', 'Mecânica 1')->get();
        return view('layouts.partials.mec1', compact('alunos'));
    }

    public function showMec2()
    {
        $alunos = Alunos::where('turma', 'Mecânica 2')->get();
        return view('layouts.partials.mec2', compact('alunos'));
    }

    public function showMec3()
    {
        $alunos = Alunos::where('turma', 'Mecânica 3')->get();
        return view('layouts.partials.mec3', compact('alunos'));
    }

    public function showCont1()
    {
        $alunos = Alunos::where('turma', 'Contabilidade 1')->get();
        return view('layouts.partials.cont1', compact('alunos'));
    }

    public function showCont2()
    {
        $alunos = Alunos::where('turma', 'Contabilidade 2')->get();
        return view('layouts.partials.cont2', compact('alunos'));
    }

    public function showCont3()
    {
        $alunos = Alunos::where('turma', 'Contabilidade 3')->get();
        return view('layouts.partials.cont3', compact('alunos'));
    }

    public function showJogos1()
    {
        $alunos = Alunos::where('turma', 'Jogos 1')->get();
        return view('layouts.partials.jogos1', compact('alunos'));
    }

    public function showJogos2()
    {
        $alunos = Alunos::where('turma', 'Jogos 2')->get();
        return view('layouts.partials.jogos2', compact('alunos'));
    }


    public function showJogos3()
    {
        $alunos = Alunos::where('turma', 'Jogos 3')->get();
        return view('layouts.partials.jogos3', compact('alunos'));
    }

    public function showPf1()
    {
        $alunos = Alunos::where('turma', 'PF 1')->get();
        return view('layouts.partials.pf1', compact('alunos'));
    }

    public function showPf2()
    {
        $alunos = Alunos::where('turma', 'PF 2')->get();
        return view('layouts.partials.pf2', compact('alunos'));
    }

    public function showPf3()
    {
        $alunos = Alunos::where('turma', 'PF 3')->get();
        return view('layouts.partials.pf3', compact('alunos'));
    }



}
