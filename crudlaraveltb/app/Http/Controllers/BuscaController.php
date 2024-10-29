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
        // Verifica se há uma pesquisa
        $search = $request->input('search');
        
        // Se houver uma pesquisa, filtra as ocorrências e as entidades de enfermaria
        if ($search) {
            // Busca ocorrências com base no título
            $ocorrencias = Ocorrencias::where('titulo', 'like', '%' . $search . '%')->get();
            
            // Busca entidades de enfermaria com base no título
            $enfermarias = Enfermaria::where('titulo', 'like', '%' . $search . '%')->get();

            $alunos = Alunos::where('nome', 'like', '%' . $search . '%')->get();
            // Passa os resultados para a view
            return view('busca.index', compact('ocorrencias', 'enfermarias', 'alunos', 'search'));
        } else {
            // Caso contrário, busca todas as ocorrências e entidades de enfermaria
            $ocorrencias = Ocorrencias::all();
            $enfermarias = Enfermaria::all();
            $alunos = Alunos::all();
            // Passa os resultados para a view
            return view('busca.index', compact('ocorrencias', 'enfermarias', 'alunos'));
        }
    }

}
