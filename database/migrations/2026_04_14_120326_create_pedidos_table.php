<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->date('dt_solicitacao')->nullable();
            $table->date('dt_entrega')->nullable();
            $table->integer('renov');
            $table->integer('max_renov')->nullable();
            $table->string('status');
            $table->boolean('ativo');
            $table->boolean('tipo'); //0: pedido, 1:reserva
            $table->string('justificativa')->nullable();
            $table->string('motivo')->nullable();
            $table->date('dt_retirada')->nullable();
            $table->date('dt_solic_entrega')->nullable();
            $table->date('dt_avaliacao')->nullable();
            $table->foreignId('id_usuario')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_avaliador')->constrained('users')->onDelete('cascade')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
