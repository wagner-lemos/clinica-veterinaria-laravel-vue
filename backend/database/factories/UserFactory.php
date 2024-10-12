<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * A senha atual sendo utilizada pela fábrica.
     */
    protected static ?string $password;

    /**
     * Define o estado padrão do modelo.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(), // Gera um nome aleatório.
            'email' => fake()->unique()->safeEmail(), // Gera um e-mail único e seguro.
            'email_verified_at' => now(), // Define a data de verificação do e-mail como o momento atual.
            'password' => static::$password ??= Hash::make('password'), // Usa uma senha padrão se ainda não tiver sido definida.
            'access_level' => $this->faker->randomElement(['recepcionista', 'medico']), // Seleciona aleatoriamente o nível de acesso (recepcionista ou médico).
            'remember_token' => Str::random(10), // Gera um token aleatório para "lembrar" o usuário.
        ];
    }

    /**
     * Indica que o endereço de e-mail do modelo deve estar não verificado.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null, // Define o campo de verificação de e-mail como nulo.
        ]);
    }
}