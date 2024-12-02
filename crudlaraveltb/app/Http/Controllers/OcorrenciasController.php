<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Ocorrencias;
use App\Models\Enfermaria;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewOcorrenciaNotification;

class OcorrenciasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     public function index(Request $request)
{
    // Verifica se há uma pesquisa
    $search = $request->input('search');
    
    // Se houver uma pesquisa, filtra as ocorrências e as entidades de enfermaria
    if ($search) {
        // Busca ocorrências com base no título
        $ocorrencias = Ocorrencias::where('titulo', 'like', '%' . $search . '%')->get();

        // Passa os resultados para a view
        return view('ocorrencias.index', compact('ocorrencias', 'enfermarias', 'search'));
    } else {
        // Caso contrário, busca todas as ocorrências e entidades de enfermaria
        $ocorrencias = Ocorrencias::all();

        // Passa os resultados para a view
        return view('ocorrencias.index', compact('ocorrencias'));
    }
}


    //Função Filtro
    public function filtro($turma)
    {
 //   $ocorrencias = Ocorrencias::where('turma', $turma)->get();
  //  return view('ocorrencias.partials.list', compact('ocorrencias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("ocorrencias.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $ocorrencia = new Ocorrencias();
    $ocorrencia->titulo = $request->titulo;
    $ocorrencia->descricao = $request->descricao;
    $ocorrencia->participantes = $request->participantes;
    $ocorrencia->data = $request->data;
    $ocorrencia->status = $request->status;
    $ocorrencia->save();

  

    return response()->json(['message' => 'Ocorrência salva com sucesso!', 'id' => $ocorrencia->id]);
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ocorrencias = Ocorrencias::findOrFail($id);
        return view("ocorrencias.show", compact("ocorrencias"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ocorrencias = Ocorrencias::findOrFail($id);
        return response()->json($ocorrencias);
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
        $ocorrencia = Ocorrencias::findOrFail($id);
        $ocorrencia->titulo = $request->titulo;
        $ocorrencia->descricao = $request->descricao;
        $ocorrencia->participantes = $request->participantes;
        $ocorrencia->data = $request->data;
        $ocorrencia->status = $request->status;
        $ocorrencia->save();

        return response()->json(['message' => 'Ocorrencia atualizado com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ocorrencias = Ocorrencias::findOrFail($id);
        $ocorrencias->delete();
        return response()->json(['message' => 'Ocorrencia excluído com sucesso!']);
    }

    public function showMonthlyChartOco(Request $request)
    {
        $turmas = $request->input('turmas', []);
    
        // Filtrar ocorrências com base nas turmas dos participantes
        $query = Ocorrencias::query();
    
        if (!empty($turmas)) {
            $query->where(function ($query) use ($turmas) {
                foreach ($turmas as $turma) {
                    $query->orWhereJsonContains('participantes', ['turma' => $turma]);
                }
            });
        }
    
        $data = $query->selectRaw('DATE_FORMAT(data, "%Y-%m") as month, JSON_EXTRACT(participantes, "$[*].turma") as turma_json, COUNT(*) as total')
                      ->groupBy('month', 'turma_json') // Adicione o campo turma_json ao GROUP BY
                      ->get();
    
        // Transformar JSON em array e calcular a contagem de turmas
        $dataFormatted = $data->map(function ($item) {
            $turmas = json_decode($item->turma_json, true);
            $turmasCount = [];
    
            foreach ($turmas as $turma) {
                if (!empty($turma)) {
                    $turmasCount[$turma] = ($turmasCount[$turma] ?? 0) + 1;
                }
            }
    
            return [
                'month' => $item->month,
                'turmas' => $turmasCount
            ];
        });
    
        return view('layouts.partials.graficosOco', ['data' => $dataFormatted]);
    }
    
    
    


       public function deletarOcorrencias(Request $request)
{
    $ocorrenciasIds = $request->input('ocorrencias');
    
    if (!$ocorrenciasIds || !is_array($ocorrenciasIds)) {
        return response()->json(['success' => false, 'message' => 'Dados inválidos'], 400);
    }

    // Exclui as ocorrências com os IDs fornecidos
    Ocorrencias::whereIn('id', $ocorrenciasIds)->delete();

    return response()->json(['success' => true]);
}

}
