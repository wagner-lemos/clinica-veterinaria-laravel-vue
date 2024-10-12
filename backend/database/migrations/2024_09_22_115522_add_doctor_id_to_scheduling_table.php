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
        Schema::table('scheduling', function (Blueprint $table) {
            // Adiciona a coluna 'doctor_id' após a coluna 'id'
            $table->integer('doctor_id')
                ->after('id')
                ->unsigned()
                ->comment('chave estrangeira para o id do médico') // Comentário que explica o propósito da coluna
                ->nullable(); // Permite que a coluna seja nula

            // Define a chave estrangeira para a coluna 'doctor_id'
            $table->foreign('doctor_id')
                ->references('id') // Referencia a coluna 'id' na tabela 'doctor'
                ->on('doctor')
                ->onUpdate('cascade') // Atualiza em cascata se o médico for atualizado
                ->onDelete('cascade'); // Deleta em cascata se o médico for deletado
        });
    }

    /**
     * Reverte as migrações.
     */
    public function down(): void
    {
        Schema::table('scheduling', function (Blueprint $table) {
            // Remove a chave estrangeira antes de remover a coluna
            $table->dropForeign('scheduling_doctor_id_foreign');
            // Remove a coluna 'doctor_id'
            $table->dropColumn('doctor_id');
        });
    }
};
