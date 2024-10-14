<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Alunos;

class AlunosPDFController extends Controller
{
    public function gerarPDF(Request $request, $id)
    {
        // Faz o select para buscar o aluno pelo ID
        $aluno = Alunos::find($id);

        // Coloca as variáveis dentro de um array
        $dados = [
            'title' => 'Ficha Geral do Estudante',
            'aluno' => $aluno, // Passa os dados do aluno
            'data' => date('d/m/Y')
        ];

        // Gera o PDF com a view e as variáveis no array
        if ($request->has('download')) {
            $pdf = Pdf::loadView('alunos.relatorio', $dados, compact('aluno'));
            return $pdf->download('ficha_aluno_' . $aluno->nome . '.pdf');
        }

        // Retorna a view com as variáveis se não for para download
        return view('alunos.relatorio', $dados);
    }

    public function index($id)
{
    // Busca um único aluno pelo ID
    $aluno = Alunos::find($id);
    
    // Certifique-se de passar a variável corretamente no singular
    return view('alunos.index', compact('aluno')); 
}
}

