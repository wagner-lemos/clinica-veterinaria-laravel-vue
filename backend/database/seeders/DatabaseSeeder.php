<?php
namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Preenche o banco de dados da aplicação.
     */
    public function run(): void
    {
        // Cria 10 usuários aleatórios.
        \App\Models\User::factory(10)->create();

        // Cria um usuário específico com nome, e-mail e senha definidos.
        \App\Models\User::factory()->create([
            'name' => 'Wagner', // Nome do usuário.
            'email' => 'wagnerlemosce@gmail.com', // E-mail do usuário.
            'password' => bcrypt('password'), // Senha do usuário, criptografada.
        ]);

        // Cria 10 agendamentos aleatórios.
        \App\Domain\Scheduling\Models\Scheduling::factory(10)->create();

        // Cria 10 médicos aleatórios.
        \App\Domain\Doctor\Models\Doctor::factory(10)->create();
    }
}