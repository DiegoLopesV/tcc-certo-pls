<?php

namespace App\Http\Controllers;

use App\Models\Enfermaria;
use App\Models\Alunos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        Log::debug($request->all());
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
        $enfermaria->responsavel = $request->responsavel;
        $enfermaria->atividade_realizada = $request->atividade_realizada;
        $enfermaria->queixa = $request->queixa;
        $enfermaria->conduta = $request->conduta;
        $enfermaria->descricao = $request->descricao;
        $enfermaria->idade = $request->idade;
        $enfermaria->horaInicio = $request->horaInicio;
        $enfermaria->horaFinal = $request->horaFinal;


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
        Log::info('Tentando excluir atendimento com ID: ' . $id);
    
        $enfermaria = Enfermaria::find($id);
        if (!$enfermaria) {
            Log::warning('Atendimento não encontrado com ID: ' . $id);
            return response()->json(['message' => 'Atendimento não encontrado.'], 404);
        }
    
        $enfermaria->delete();
        Log::info('Atendimento excluído com sucesso: ' . $id);
    
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

    public function deletarEnfermarias(Request $request)
    {
        $enfermariasIds = $request->input('enfermarias');
        
        if (!$enfermariasIds || !is_array($enfermariasIds)) {
            return response()->json(['success' => false, 'message' => 'Dados inválidos'], 400);
        }
    
        // Exclui as ocorrências com os IDs fornecidos
        Enfermaria::whereIn('id', $enfermariasIds)->delete();
    
        return response()->json(['success' => true]);
    }
    
}
