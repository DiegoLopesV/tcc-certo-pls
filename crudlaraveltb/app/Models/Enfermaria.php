<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enfermaria extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'pessoas',
        'turma',
        'data',
        'status',
        ];
}
