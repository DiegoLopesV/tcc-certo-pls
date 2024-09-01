<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Disciplina;

class DisciplinaPDFController extends Controller
{
    
    public function gerarPDF (Request $request){
        
        $disciplinas = Disciplina::where("professor_id", $request["professor_id"])->orderBy("id")->paginate(10);

        $dados = [
            "title" => "Relatório gerado pelo Laravel",
            "disciplinas" => $disciplinas,
            "data" => date('d/m/Y')
        ];
        
    $pdf = Pdf::loadView('disciplinas.relatorio', $dados);
    return $pdf->download('disciplinasProfessores_pdf_exemplo.pdf');
        
        
        
        
    }
    
}
