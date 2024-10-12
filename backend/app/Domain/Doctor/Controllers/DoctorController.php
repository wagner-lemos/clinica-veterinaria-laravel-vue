<?php
declare(strict_types=1);

namespace App\Domain\Doctor\Controllers;

use App\Domain\Doctor\Repositories\DoctorRepository; // Importa o repositório do médico
use App\Http\Controllers\Controller; // Importa a classe base Controller
use Illuminate\Http\Request; // Importa a classe Request

class DoctorController extends Controller
{
    protected DoctorRepository $repository; // Propriedade do repositório

    protected array $validators = [ // Validações para os dados do médico
        'name' => 'required|string|max:255',
        'specialty' => 'required|string|max:255',
        'phone' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:doctor',
    ];

    /**
     * @param DoctorRepository $repository
     */
    public function __construct(DoctorRepository $repository)
    {
        $this->repository = $repository; // Injeção de dependência do repositório
    }

    public function index(Request $request)
    {
        return parent::index($request); // Chama o método index da classe pai
    }

    public function store(Request $request)
    {
        return parent::store($request); // Chama o método store da classe pai
    }

    public function update(Request $request, int $id)
    {
        return parent::update($request, $id); // Chama o método update da classe pai
    }

    public function destroy(int $id)
    {
        return parent::destroy($id); // Chama o método destroy da classe pai
    }
}