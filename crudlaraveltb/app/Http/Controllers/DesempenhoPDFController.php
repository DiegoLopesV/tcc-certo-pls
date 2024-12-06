<?php

namespace App\Http\Controllers;

use App\Models\Alunos;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class DesempenhoPDFController extends Controller
{
    public function gerarDesempenhoPDF($id)
    {
        // Buscar o aluno pelo ID
        $aluno = Alunos::find($id);

        if (!$aluno) {
            return response()->json(['message' => 'Aluno não encontrado.'], 404);
        }

        // Gerar o PDF com os dados do aluno
        $pdf = PDF::loadView('desempenho.relatorio', compact('aluno'));

        // Retornar o PDF como download
        return $pdf->download('desempenho_individual_' . $aluno->id . '.pdf');
    }
}