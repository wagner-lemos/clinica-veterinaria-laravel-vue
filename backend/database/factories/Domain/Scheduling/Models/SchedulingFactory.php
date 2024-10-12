<?php
namespace Database\Factories\Domain\Scheduling\Models;

use App\Domain\Scheduling\Models\Scheduling;
use Illuminate\Database\Eloquent\Factories\Factory;

class SchedulingFactory extends Factory
{
    /**
     * O nome do modelo correspondente à fábrica.
     *
     * @var string
     */
    protected $model = Scheduling::class;

    /**
     * Define o estado padrão do modelo.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'doctor_id' => function () {
                return \App\Domain\Doctor\Models\Doctor::factory()->create()->id; // Cria um médico e retorna seu ID.
            },
            'name' => $this->faker->name, // Gera um nome aleatório.
            'email' => $this->faker->safeEmail, // Gera um e-mail seguro.
            'animal_name' => $this->faker->firstName, // Gera um nome de animal aleatório.
            'animal_type' => $this->faker->randomElement(['cão', 'gato', 'pássaro', 'réptil']), // Seleciona aleatoriamente um tipo de animal.
            'age' => $this->faker->numberBetween(1, 15), // Gera uma idade aleatória entre 1 e 15 anos.
            'symptoms' => $this->faker->sentence, // Gera uma descrição de sintomas aleatória.
            'date' => $this->faker->date(), // Gera uma data aleatória.
            'period' => $this->faker->randomElement(['manhã', 'tarde']), // Seleciona aleatoriamente um período (manhã ou tarde).
        ];
    }
}
