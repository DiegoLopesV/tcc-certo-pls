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
}
