<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Alunos;

class AlunosPDFController extends Controller
{
    public function gerarRelatorioNapne(Request $request)
    {
        // Recebe os dados do formulário
        $dados = $request->all();

        // Gera o PDF usando a view 'alunos.relatorio-napne'
        $pdf = Pdf::loadView('alunos.relatorio', ['dados' => $dados]);

        // Retorna o PDF para download
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

