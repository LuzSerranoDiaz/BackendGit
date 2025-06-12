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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('contrasena');
            $table->string('nombre');
            $table->string('nombreUsuario');
            $table->boolean('isAdmin')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            /* $table->boolean('is_email_verified')->default(0); */
            $table->string('verification_token', 64)->nullable();
            $table->string('reset_token', 64)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
