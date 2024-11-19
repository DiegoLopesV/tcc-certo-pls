<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enfermeiros extends Model
{
    use HasFactory;

    protected $fillable = [
        "nome",
        "cpf",
        "telefone",
        'foto',
        "numeroDeContrato",
        "data_nascimento",
        "email",
        "chave",
    ];
}
