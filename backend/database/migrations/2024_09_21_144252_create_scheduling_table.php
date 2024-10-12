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
        Schema::create('scheduling', function (Blueprint $table) {
            $table->increments('id'); // Cria a coluna 'id' como chave primária auto-incremento.
            $table->string('name')->nullable(); // Cria a coluna 'name' que pode ser nula.
            $table->string('email')->nullable(); // Cria a coluna 'email' que pode ser nula.
            $table->string('animal_name')->nullable(); // Cria a coluna 'animal_name' que pode ser nula.
            $table->string('animal_type')->nullable(); // Cria a coluna 'animal_type' que pode ser nula.
            $table->string('age')->nullable(); // Cria a coluna 'age' que pode ser nula.
            $table->string('symptoms')->nullable(); // Cria a coluna 'symptoms' que pode ser nula.
            $table->date('date')->nullable(); // Cria a coluna 'date' que pode ser nula.
            $table->string('period')->nullable(); // Cria a coluna 'period' que pode ser nula.
            $table->timestamps(); // Cria as colunas 'created_at' e 'updated_at'.
            $table->softDeletes(); // Cria a coluna 'deleted_at' para uso de soft deletes.
        });
    }

    /**
     * Reverte as migrações.
     */
    public function down(): void
    {
        Schema::dropIfExists('scheduling'); // Remove a tabela 'scheduling' se existir.
    }
};
