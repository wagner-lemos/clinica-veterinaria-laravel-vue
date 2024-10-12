<?php
declare(strict_types=1); // Força a declaração de tipos no código PHP

namespace App\Http\Controllers;

use App\Traits\ControllerTrait; // Importa um trait personalizado
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // Permite controlar autorização de acesso
use Illuminate\Foundation\Bus\DispatchesJobs; // Habilita o uso de jobs (tarefas) na aplicação
use Illuminate\Foundation\Validation\ValidatesRequests; // Habilita a validação de requisições HTTP
use Illuminate\Routing\Controller as BaseController; // Importa a classe base de controladores do Laravel

/**
 * Classe base para todos os controladores do projeto.
 * Esta classe serve como ponto comum para incluir comportamentos e
 * funcionalidades que serão utilizadas em todos os controladores da aplicação.
 *
 * Ela estende o controlador base do Laravel e faz uso de diversos traits que fornecem
 * métodos importantes para validação, autorização e execução de jobs.
 */
class Controller extends BaseController
{
    // Traits que adicionam funcionalidades úteis ao controlador

    use AuthorizesRequests; // Fornece métodos para autorizar ações dos usuários
    use DispatchesJobs; // Permite disparar (executar) jobs da fila
    use ValidatesRequests; // Adiciona métodos para validar requisições HTTP
    use ControllerTrait; // Trait personalizada que pode conter métodos comuns a vários controladores
}
