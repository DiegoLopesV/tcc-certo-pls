<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Alunos;

class AlunosPDFController extends Controller
{
    public function gerarRelatorioNapne(Request $request)
    {
        // Valida os dados do formulário
        $request->validate([
            'bimestre' => 'required|string',
            'aluno' => 'required|string',
            'cursoTurma' => 'required|string',
            'disciplina' => 'required|string',
            'professor' => 'required|string',
            'objetivos' => 'nullable|string',
            'participacao' => 'nullable|string',
            'avaliacao' => 'nullable|string',
            'metodos' => 'nullable|string',
            'dificuldades' => 'nullable|string',
            'informacoes' => 'nullable|string',
            'data' => 'required|date',
        ]);

        // Captura os dados validados
        $dados = $request->all();

        // Gera o PDF com os dados
        $pdf = PDF::loadView('alunos.relatorio', ['dados' => $dados]);

        // Retorna o PDF como um blob para download
        return $pdf->download('relatorio_napne_' . $dados['aluno'] . '.pdf');
    }





    public function index($id)
{
    // Busca um único aluno pelo ID
    $aluno = Alunos::find($id);
    
    // Certifique-se de passar a variável corretamente no singular
    return view('alunos.index', compact('aluno')); 
}
}

