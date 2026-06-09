<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Componente extends Model
{
    protected $fillable = ['name', 'qt_total', 'qt_disponivel', 'qt_estragada', 'name', 'descricao', 'foto1', 'foto2', 'foto3', 'foto4'];

    public function pedidos() {
        return $this->belongsToMany(Pedido::class, 'pedido_componentes', 'componente_id', 'pedido_id')->withPivot('quantidade')->withTimestamps();
    }

    public function getFotosAttribute(): array
    {
        $fotos = array_filter([
            $this->foto1,
            $this->foto2,
            $this->foto3,
            $this->foto4,
        ]);

        if (empty($fotos)) {
            return [asset('imagens/componente_padrao.png')];
        }

        return array_map(fn($foto) => asset(Storage::url($foto)), array_values($fotos));
    }
}
