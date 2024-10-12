<?php

declare(strict_types=1);

namespace App\Domain\Scheduling\Repositories;

use App\Domain\Scheduling\Models\Scheduling; // Importa o modelo Scheduling
use App\Domain\Scheduling\Resources\SchedulingCollection; // Importa a coleção SchedulingCollection
use App\Domain\Scheduling\Support\DoctorRelationships; // Importa as relações do modelo Doctor
use Illuminate\Support\Facades\DB; // Importa a fachada DB para operações de banco de dados
use Spatie\QueryBuilder\AllowedFilter; // Importa a classe para filtros permitidos
use Spatie\QueryBuilder\QueryBuilder; // Importa a classe para construir consultas

/**
 * @property DoctorRelationships $doctorRelationships
 */

class SchedulingRepository
{
    protected DoctorRelationships $doctorRelationships; // Define a propriedade doctorRelationships

    public function __construct(DoctorRelationships $doctorRelationships)
    {
        $this->doctorRelationships = $doctorRelationships; // Inicializa a propriedade no construtor
    }

    public function index()
    {
        // Cria uma consulta com as relações de médico
        $query = Scheduling::with((new DoctorRelationships())->get());

        // Usa QueryBuilder para aplicar filtros e ordenação
        $result = QueryBuilder::for($query)
            ->allowedFilters([
                AllowedFilter::exact('date', 'date'), // Filtro exato por data
                AllowedFilter::partial('type', 'animal_type'), // Filtro parcial por tipo de animal
                AllowedFilter::partial('id', 'id'), // Filtro parcial por ID
            ])
            ->defaultSort('created_at') // Define a ordenação padrão
            ->get(); // Executa a consulta e obtém os resultados

        // Cria uma nova instância de SchedulingCollection com os resultados
        $returnconteudoTreinamentoCollection = new SchedulingCollection($result);

        return $returnconteudoTreinamentoCollection->resource; // Retorna a coleção de agendamentos
    }

    /**
     * @throws Exception
     */
    public function store(array $data): Scheduling
    {
        try {
            DB::beginTransaction(); // Inicia uma transação

            $createdScheduling = Scheduling::create($data); // Cria um novo agendamento

            DB::commit(); // Confirma a transação
        } catch (\Exception $exception) {
            DB::rollback(); // Reverte a transação em caso de erro
            throw new \Exception($exception->getMessage()); // Lança a exceção
        }

        return $createdScheduling; // Retorna o agendamento criado
    }

    public function update(array $data, int $id)
    {
        $updateScheduling = Scheduling::find($id); // Encontra o agendamento pelo ID

        return $updateScheduling->fill($data)->save(); // Preenche os dados e salva as alterações
    }

    public function destroy(int $id): bool
    {
        return (bool) Scheduling::destroy($id); // Remove o agendamento pelo ID e retorna verdadeiro ou falso
    }
}