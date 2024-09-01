<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    use HasFactory;
    
    protected $fillable = [
        "nome",
        "curso",
        "sigla",
        "carga_horaria"
    ];
    
    public function professor() : BelongsTo
    {
        return $this->belongsTo(Professor::class);
    }
    
    
}
