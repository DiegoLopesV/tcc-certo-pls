<?php

namespace App\Http\Controllers;

use App\Models\Enfermaria;
use App\Models\Alunos;
use Illuminate\Http\Request;

class EnfermariaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $enfermaria = Enfermaria::all();
        $aluno = Alunos::find(1);
        return view('enfermaria.index', compact('enfermaria', 'aluno'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("enfermaria.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $enfermaria = Enfermaria::create($request->all());
        return response()->json(['message' => 'Atendimento salvo com sucesso!', 'id' => $enfermaria->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $enfermaria = Enfermaria::findOrFail($id);
        return view("enfermaria.show", compact("enfermaria"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $enfermaria = Enfermaria::findOrFail($id);
        return response()->json($enfermaria);
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
        $enfermaria = Enfermaria::findOrFail($id);
        $enfermaria->titulo = $request->titulo;
        $enfermaria->descricao = $request->descricao;
        $enfermaria->pessoas = $request->pessoas;
        $enfermaria->turma = $request->turma;
        $enfermaria->data = $request->data;
        $enfermaria->status = $request->status;
        $enfermaria->save();

        return response()->json(['message' => 'Atendimento atualizado com sucesso!']);
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
        $enfermaria = Enfermaria::findOrFail($id);
        $enfermaria->delete();
        return response()->json(['message' => 'Atendimento excluído com sucesso!']);
    }

    //Função Graficos Enfermaria
    public function showMonthlyChart(Request $request)
    {
        $turmas = $request->input('turmas', []);
        
        // Filtrar atendimentos por turma se as turmas estiverem definidas
        $query = Enfermaria::query();
        
        if ($turmas) {
            $query->whereIn('turma', $turmas);
        }
        
        $data = $query->selectRaw('DATE_FORMAT(data, "%Y-%m") as month, turma, COUNT(*) as total')
                      ->groupBy('month', 'turma')
                      ->get();
        
        return view('layouts.partials.graficosEnf', compact('data'));
    }
    
}
