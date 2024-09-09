<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Enfermaria;


class EnfermariaPDFController extends Controller
{
    
    public function gerarPDF (Request $request){
        
        $enfermaria = Enfermaria::orderBy("id", "desc")->get();
        
        $dados = [
            "title" => "Relatório Geral de Enfermaria",
            "enfermaria" => $enfermaria,
            "data" => date('d/m/Y')
        ];
        
        if($request->has('download'))
        {
            
            $pdf = Pdf::loadView('enfermaria.relatorio', $dados);
            return $pdf->download('enfermaria_pdf_exemplo.pdf');
        }
        
        
        
    }
    
    

    
}
