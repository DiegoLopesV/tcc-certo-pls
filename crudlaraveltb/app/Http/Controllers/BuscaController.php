<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ocorrencias;
use App\Models\Enfermaria;
use App\Models\Alunos;

class BuscaController extends Controller
{

    public function index(Request $request)
    {
        // Obtém o valor enviado no campo 'search'
        $search = $request->input('search');

        // Consulta para alunos com filtros combinados
        $alunos = Alunos::query()
            ->where(function ($query) use ($search) {
                $query->where('nome', 'like', '%' . $search . '%')
                    ->orWhere('turma', 'like', '%' . $search . '%');
            })
            ->get();

        // Consulta para ocorrências
        $ocorrencias = Ocorrencias::query()
            ->where('titulo', 'like', '%' . $search . '%')
            ->get();

        // Consulta para enfermarias
        $enfermarias = Enfermaria::query()
            ->where('titulo', 'like', '%' . $search . '%')
            ->get();

        // Retorna os resultados para a view
        return view('busca.index', compact('ocorrencias', 'enfermarias', 'alunos', 'search'));

    }

}
