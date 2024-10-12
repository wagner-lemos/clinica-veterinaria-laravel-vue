<?php
declare(strict_types=1);

namespace App\Domain\Doctor\Repositories;

use App\Domain\Doctor\Models\Doctor; // Importa o modelo Doctor
use App\Domain\Doctor\Resources\DoctorCollection; // Importa a coleção de recursos para Doctors
use Illuminate\Support\Facades\DB; // Importa o facade DB para manipulação do banco de dados
use Spatie\QueryBuilder\AllowedFilter; // Importa AllowedFilter para filtrar as consultas
use Spatie\QueryBuilder\QueryBuilder; // Importa QueryBuilder para construção de consultas

class DoctorRepository
{
    public function index()
    {
        $query = Doctor::class; // Define a classe Doctor para a consulta

        $query = QueryBuilder::for($query)
            ->allowedFilters([ // Define os filtros permitidos para a consulta
                AllowedFilter::exact('doctor_name', 'name'),
                AllowedFilter::partial('specialty_name', 'specialty'),
            ])
            ->defaultSort('created_at') // Define a ordenação padrão
            ->get(); // Executa a consulta

        $returnDoctorCollection = new DoctorCollection($query); // Cria uma coleção de Doctors

        return $returnDoctorCollection->resource; // Retorna a coleção
    }

    /**
     * @throws Exception
     */
    public function store(array $data): Doctor
    {
        try {
            DB::beginTransaction(); // Inicia uma transação

            $createdDoctor = Doctor::create($data); // Cria um novo registro de Doctor

            DB::commit(); // Confirma a transação
        } catch (\Exception $exception) {
            DB::rollback(); // Reverte a transação em caso de erro
            throw new \Exception($exception->getMessage()); // Lança a exceção
        }

        return $createdDoctor; // Retorna o novo registro criado
    }

    public function update(array $data, int $id)
    {
        $updateDoctor = Doctor::find($id); // Busca o Doctor pelo ID

        return $updateDoctor->fill($data)->save(); // Preenche e salva os dados atualizados
    }

    public function destroy(int $id): bool
    {
        return (bool) Doctor::destroy($id); // Exclui o registro de Doctor e retorna o resultado
    }
}