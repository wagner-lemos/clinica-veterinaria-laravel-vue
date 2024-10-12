<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Executa as migrações.
     */
    public function up(): void
    {
        Schema::create('doctor', function (Blueprint $table) {
            $table->increments('id')->unsigned(); // Cria a coluna 'id' como chave primária auto-incremento e sem sinal.
            $table->string('name')->nullable(); // Cria a coluna 'name' que pode ser nula.
            $table->string('specialty')->nullable(); // Cria a coluna 'specialty' que pode ser nula.
            $table->string('phone')->nullable(); // Cria a coluna 'phone' que pode ser nula.
            $table->string('email')->unique()->nullable(); // Cria a coluna 'email' que deve ser única e pode ser nula.
            $table->timestamps(); // Cria as colunas 'created_at' e 'updated_at'.
            $table->softDeletes(); // Cria a coluna 'deleted_at' para uso de soft deletes.
        });
    }

    /**
     * Reverte as migrações.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor'); // Remove a tabela 'doctor' se existir.
    }
};
