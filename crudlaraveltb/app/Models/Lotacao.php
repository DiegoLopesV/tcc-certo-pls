<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lotacao extends Model
{
    use HasFactory;
    
    protected $fillable = [
        "nome_campus",
        "departamento",
        "area_atuacao"
    ];
    
    public function professor(): BelongsTo
    {
        return $this->belongsTo(Professor::class);
    }
    
}
