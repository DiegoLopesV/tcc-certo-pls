<?php

namespace App\Http\Controllers;
use App\Models\Alunos;
use App\Models\Ocorrencias;
use App\Models\Enfermaria;
use Barryvdh\DomPDF\Facade\Pdf;

class DesempenhoPDFController extends Controller
{
    public function gerarDesempenhoPDF($id)
    {
        // Buscar o aluno pelo ID
        $aluno = Alunos::find($id);

        if (!$aluno) {
            return response()->json(['message' => 'Aluno não encontrado.'], 404);
        }

        // Obter ocorrências filtradas
        $ocorrencias = $this->filtrarOcorrenciasAluno($aluno);

        // Obter enfermarias filtradas
        $enfermarias = $this->filtrarEnfermariasAluno($aluno);

        // Gerar o PDF com os dados do aluno, ocorrências e enfermarias
        $pdf = PDF::loadView('desempenho.relatorio', compact('aluno', 'ocorrencias', 'enfermarias'));

        // Retornar o PDF como download
        return $pdf->download('desempenho_individual_' . $aluno->id . '.pdf');
    }

    private function filtrarOcorrenciasAluno($aluno)
    {
        $ocorrencias = Ocorrencias::all();

        return $ocorrencias->filter(function ($ocorrencia) use ($aluno) {
            $participantes = is_string($ocorrencia->participantes)
                ? json_decode($ocorrencia->participantes, true)
                : $ocorrencia->participantes;

            if (!is_array($participantes)) {
                $participantes = [];
            }

            foreach ($participantes as $participante) {
                if (
                    isset($participante['nome'], $participante['curso'], $participante['turma']) &&
                    $participante['nome'] === $aluno->nome &&
                    $participante['curso'] === $aluno->curso &&
                    $participante['turma'] === $aluno->turma
                ) {
                    return true;
                }
            }
            return false;
        })->values();
    }

    private function filtrarEnfermariasAluno($aluno)
    {
        $enfermarias = Enfermaria::all();

        return $enfermarias->filter(function ($enfermaria) use ($aluno) {
            // Verificar diretamente o nome e a turma da enfermaria
            return $enfermaria->pessoas === $aluno->nome && $enfermaria->turma === $aluno->turma;
        })->values();
    }
}
