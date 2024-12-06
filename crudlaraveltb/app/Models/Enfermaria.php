<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enfermaria extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'horaInicio',
        'horaFinal',
        'responsavel',
        'idade',
        'queixa',
        'atividade_realizada',
        'conduta',
        'descricao',
        'pessoas',
        'turma',
        'data',
        ];
}
