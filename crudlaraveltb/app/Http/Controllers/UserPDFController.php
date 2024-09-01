<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;


class UserPDFController extends Controller
{
    
    public function gerarPDF (Request $request){
        
        $users = User::orderBy("id", "desc")->get();
        
        $dados = [
            "title" => "Esse é o PDF",
            "users" => $users,
            "data" => date('d/m/Y')
        ];
        
        if($request->has('download'))
        {
            
            $pdf = Pdf::loadView('usuarios.relatorio', $dados);
            return $pdf->download('usuarios_pdf_exemplo.pdf');
        }
        
        
        
    }
    
    
}
