<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChaveTemporaria extends Model
{
    use HasFactory;

    protected $table = 'chaves_temporarias';

    // Defina os campos que podem ser preenchidos
    protected $fillable = [
        'nome',
        'chave',
    ];
}
