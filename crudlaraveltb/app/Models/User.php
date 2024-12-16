<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'cpf',
        'nome_pais',
        'telefone',
        'telefone_pais',
        'email',
        'email_pais',
        'role',
        'password',
        'key',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function endereco()
    {
        return $this->hasOne(Endereco::class);
    }

    public function solicitacoes()
    {
        return $this->hasMany(Solicitacao::class);
    }


    // app/Models/User.php

    public function getFotoAttribute()
    {
        // Verifica em todas as tabelas relacionadas
        $roles = [
            'Administradores' => Administradores::class,
            'Professores' => Professor::class,
            'Terceirizados' => Terceirizados::class,
            'Enfermeiros' => Enfermeiros::class,
            'Alunos' => Alunos::class,
        ];

        foreach ($roles as $role => $model) {
            if ($model::where('email', $this->email)->exists()) {
                return $model::where('email', $this->email)->value('foto');
            }
        }

        // Foto padrão se nenhuma encontrada
        return 'assets/img/default.png';
    }

}
