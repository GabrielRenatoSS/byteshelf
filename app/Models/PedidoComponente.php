<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoComponente extends Model
{
    protected $fillable = ['quantidade', 'componente_id', 'pedido_id'];

    public function pedido() {
        return $this->belongsTo(Pedido::class, 'pedido_id');
    }

    public function componente() {
        return $this->belongsTo(Componente::class, 'componente_id');
    }
}
