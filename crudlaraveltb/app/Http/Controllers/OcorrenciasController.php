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
        
        // Busca entidades de enfermaria com base no título
        $enfermarias = Enfermaria::where('titulo', 'like', '%' . $search . '%')->get();

        // Passa os resultados para a view
        return view('ocorrencias.index', compact('ocorrencias', 'enfermarias', 'search'));
    } else {
        // Caso contrário, busca todas as ocorrências e entidades de enfermaria
        $ocorrencias = Ocorrencias::all();
        $enfermarias = Enfermaria::all();

        // Passa os resultados para a view
        return view('ocorrencias.index', compact('ocorrencias', 'enfermarias'));
    }
}


    //Função Filtro
    public function filtro($turma)
    {
    $ocorrencias = Ocorrencias::where('turma', $turma)->get();
    return view('ocorrencias.partials.list', compact('ocorrencias'));
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
    $ocorrencia->turma = $request->turma;
    $ocorrencia->data = $request->data;
    $ocorrencia->status = $request->status;
    $ocorrencia->save();

    // Enviar notificação
    Notification::send(auth()->user(), new NewOcorrenciaNotification($ocorrencia));

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
        $ocorrencia->turma = $request->turma;
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


       //Função Graficos Ocorrências
       public function showMonthlyChartOco(Request $request)
       {
           $turmas = $request->input('turmas', []);
           
           // Filtrar atendimentos por turma se as turmas estiverem definidas
           $query = Ocorrencias::query();
           
           if ($turmas) {
               $query->whereIn('turma', $turmas);
           }
           
           $data = $query->selectRaw('DATE_FORMAT(data, "%Y-%m") as month, turma, COUNT(*) as total')
                         ->groupBy('month', 'turma')
                         ->get();
           
           return view('layouts.partials.graficosOco', compact('data'));
       }
}
