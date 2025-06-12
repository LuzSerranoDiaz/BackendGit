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
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('empleado_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            //$table->foreignId('contrato_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('fecha');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->enum('estado', ['pendiente', 'cancelado', 'completado']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
