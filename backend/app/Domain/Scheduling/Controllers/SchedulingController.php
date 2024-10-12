<?php

declare(strict_types=1);

namespace App\Domain\Scheduling\Controllers;

use App\Domain\Scheduling\Repositories\SchedulingRepository; // Importa o repositório
use App\Http\Controllers\Controller; // Importa a classe base Controller
use Illuminate\Http\Request; // Importa a classe Request

class SchedulingController extends Controller
{
    protected SchedulingRepository $repository; // Propriedade para armazenar o repositório

    protected array $validators = [ // Regras de validação para os dados de agendamento
        'doctor_id' => 'nullable|integer',
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:scheduling',
        'animal_name' => 'required|string|max:255',
        'animal_type' => 'required|string|max:255',
        'age' => 'nullable|integer',
        'symptoms' => 'nullable|string|max:65535',
        'date' => 'nullable|date',
        'period' => 'required|string|in:manhã,tarde',
    ];

    /**
     * @param SchedulingRepository $repository
     */
    public function __construct(SchedulingRepository $repository)
    {
        $this->repository = $repository; // Injeta o repositório no controlador
    }

    public function index(Request $request)
    {
        return parent::index($request); // Chama o método index do controlador pai
    }

    public function store(Request $request)
    {
        return parent::store($request); // Chama o método store do controlador pai
    }

    public function update(Request $request, int $id)
    {
        return parent::update($request, $id); // Chama o método update do controlador pai
    }

    public function destroy(int $id)
    {
        return parent::destroy($id); // Chama o método destroy do controlador pai
    }
}
