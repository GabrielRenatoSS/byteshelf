<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proposta extends Model
{
    protected $fillable = [
        'user_id',
        'avaliador_id',
        'dt_proposta',
        'dt_avaliacao',
        'dt_entrega',
        'parecer',
        'status',
        'descricao',
        'foto',
    ];

    protected $casts = [
        'dt_proposta' => 'datetime',
        'dt_avaliacao' => 'datetime',
        'dt_entrega' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function avaliador()
    {
        return $this->belongsTo(User::class, 'avaliador_id');
    }
}