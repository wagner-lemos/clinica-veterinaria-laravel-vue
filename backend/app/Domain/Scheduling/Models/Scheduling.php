<?php
declare(strict_types=1);

namespace App\Domain\Scheduling\Models;

use App\Domain\Doctor\Models\Doctor; // Importa o modelo Doctor
use Illuminate\Database\Eloquent\Factories\HasFactory; // Importa o trait para fábricas
use Illuminate\Database\Eloquent\Model; // Importa a classe base para modelos Eloquent
use Illuminate\Database\Eloquent\Relations\HasMany; // Importa a classe para relações "um para muitos"
use Illuminate\Database\Eloquent\SoftDeletes; // Importa a classe para Soft Deletes

class Scheduling extends Model
{
    use HasFactory; // Usa o trait HasFactory para suporte a fábricas de modelos
    use SoftDeletes; // Usa o trait SoftDeletes para permitir exclusões suaves

    public const TABLE_NAME = 'scheduling'; // Define o nome da tabela

    public const PRIMARY_KEY = 'id'; // Define a chave primária

    public const FILLABLE = [
        'doctor_id',
        'name',
        'email',
        'animal_name',
        'animal_type',
        'age',
        'symptoms',
        'date',
        'period',
    ]; // Define os campos que podem ser preenchidos em massa

    public $fillable = self::FILLABLE; // Atribui os campos preenchíveis

    protected $primaryKey = self::PRIMARY_KEY; // Define a chave primária

    protected $table = self::TABLE_NAME; // Define o nome da tabela

    public function doctor(): HasMany // Define a relação "um para muitos" com o modelo Doctor
    {
        return $this->hasMany(Doctor::class, 'id', 'doctor_id');
    }
}