<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alunos extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'cpf',
        'nome_pais',
        'telefone',
        'telefone_pais',
        'email',
        'email_pais',
        'curso',
        'turma',
        'ano_atual',
        'foto',
        'status_reprovacao',
    ];

    // No modelo Alunos
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    

    public static $rules = [
        'cpf' => 'required|unique:alunos,cpf',
        'email' => 'required|email|unique:alunos,email', // Regra de validação para CPF
    ];
}
