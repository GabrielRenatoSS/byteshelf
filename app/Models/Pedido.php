<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    /** @use HasFactory<\Database\Factories\PedidoFactory> */
    use HasFactory;
 
    protected $fillable = ['dt_solicitacao', 'dt_entrega', 'renov', 'max_renov', 'status', 'tipo', 'justificativa', 'dt_retirada', 'dt_solic_entrega', 'dt_avaliacao', 'id_usuario', 'id_avaliador', 'ativo'];
    public function componentes() {
        return $this->belongsToMany(Componente::class, 'pedido_componentes', 'pedido_id', 'componente_id')>withPivot('quantidade')->withTimestamps();
    }

    public function usuario() {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function avaliador() {
        return $this->belongsTo(User::class, 'id_avaliador');
    }
}
