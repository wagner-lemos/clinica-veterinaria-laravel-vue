<?php
namespace Database\Factories\Domain\Doctor\Models;

use App\Domain\Doctor\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;

class DoctorFactory extends Factory
{
    /**
     * O nome do modelo correspondente à fábrica.
     *
     * @var string
     */
    protected $model = Doctor::class;

    /**
     * Define o estado padrão do modelo.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name, // Gera um nome aleatório.
            'specialty' => $this->faker->randomElement(['Cardiologia', 'Pediatria', 'Dermatologia', 'Ortopedia']), // Seleciona aleatoriamente uma especialidade.
            'phone' => $this->faker->phoneNumber, // Gera um número de telefone aleatório.
            'email' => $this->faker->unique()->safeEmail, // Gera um e-mail único e seguro.
        ];
    }
}