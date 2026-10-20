<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

    protected $fillable = [
        'name', 'email', 'password', 'cpf', 'telefone',
        'tipo', 'matricula', 'bloqueio', 'dt_nasc', 'foto'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }

    public function propostas()
    {
        return $this->hasMany(Proposta::class, 'user_id');
    }

    public function propostasAvaliadas()
    {
        return $this->hasMany(Proposta::class, 'avaliador_id');
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'user_id');
    }

    public function pedidosAvaliados()
    {
        return $this->hasMany(Pedido::class, 'avaliador_id');
    }
}
