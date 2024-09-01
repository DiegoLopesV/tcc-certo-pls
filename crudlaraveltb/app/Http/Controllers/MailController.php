<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TesteMail; 
use App\Models\Disciplina;
use App\Models\Professor;

class MailController extends Controller
{
    public function index($id)
    {
        // Encontrar o professor com o ID fornecido
        $professor = Professor::findOrFail($id);

        // Obter todas as disciplinas associadas a esse professor e ordená-las por ID
        $disciplinas = Disciplina::where("professor_id", $id)->orderBy("id")->get();
        
        // Dados a serem passados para o Mailable TesteMail
        $mailData = [
            'title' => 'E-mail do sistema', 
            'body' => 'E-mail de teste Laravel', 
            'disciplinas' => $disciplinas 
        ];
        
        // Enviar o e-mail usando o Mailable TesteMail
        Mail::to($professor->email)->send(new TesteMail($mailData));
    }
}
