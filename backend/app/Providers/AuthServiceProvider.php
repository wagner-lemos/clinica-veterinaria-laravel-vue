<?php
namespace App\Providers;

use App\Models\User; // Importa o modelo User
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider; // Extende a classe base AuthServiceProvider
use Illuminate\Support\Facades\Gate; // Importa a fachada Gate para definir permissões

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Mapeamento de modelos para políticas na aplicação.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // Aqui você pode mapear modelos para suas respectivas políticas de autorização
        // Exemplo: User::class => UserPolicy::class
    ];

    /**
     * Registra quaisquer serviços de autenticação/autorização.
     */
    public function boot(): void
    {
        // Define uma nova "gate" chamada 'access'
        Gate::define('access', function (User $user) {
            return $user->access_level; // Retorna o nível de acesso do usuário
        });

        // Define uma nova "gate" chamada 'access-receptionist'
        Gate::define('access-receptionist', function (User $user) {
            return $user->access_level == 'recepcionista'; // Verifica se o nível de acesso é 'recepcionista'
        });

        // Define uma nova "gate" chamada 'access-doctor'
        Gate::define('access-doctor', function (User $user) {
            return $user->access_level == 'medico'; // Verifica se o nível de acesso é 'medico'
        });
    }
}