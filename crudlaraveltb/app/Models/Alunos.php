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
        'status_reprovacao',
    ];
}
