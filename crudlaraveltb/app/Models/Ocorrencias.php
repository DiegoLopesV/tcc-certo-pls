<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ocorrencias extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'data',
        'status',
        ];

        protected $casts = [
            'participantes' => 'array', // Aqui indicamos que o campo é um array
        ];
        
}
