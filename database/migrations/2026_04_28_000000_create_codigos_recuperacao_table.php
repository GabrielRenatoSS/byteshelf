<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('codigos_recuperacao', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('codigo', 6);
            $table->timestamp('expira_em');
            $table->timestamps();

            $table->index('email');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('codigos_recuperacao');
    }
};
