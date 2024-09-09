<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Ocorrencias;


class OcorrenciasPDFController extends Controller
{
    
    public function gerarPDF (Request $request){
        
        $ocorrencias = Ocorrencias::orderBy("id", "desc")->get();
        
        $dados = [
            "title" => "Relatório Geral de Ocorrências",
            "ocorrencias" => $ocorrencias,
            "data" => date('d/m/Y')
        ];
        
        if($request->has('download'))
        {
            
            $pdf = Pdf::loadView('ocorrencias.relatorio', $dados);
            return $pdf->download('ocorrencias_pdf_exemplo.pdf');
        }
        
        
        
    }
    
    
}
