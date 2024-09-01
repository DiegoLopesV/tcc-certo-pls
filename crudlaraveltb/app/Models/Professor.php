<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    use HasFactory;
    
    protected $fillable = [
        "nome",
        "cpf",
        "data_nascimento",
        "email"
    ];
    
    public function lotacao()
    {
        return $this->hasOne(Lotacao::class);
    }
    
    public function disciplinas()
    {
        return $this->hasMany(Disciplina::class);
    }
    
    
}
