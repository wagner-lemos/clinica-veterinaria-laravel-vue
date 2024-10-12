<?php
declare(strict_types=1);

namespace App\Domain\Doctor\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Importa o trait HasFactory
use Illuminate\Database\Eloquent\Model; // Importa a classe Model do Eloquent
use Illuminate\Database\Eloquent\SoftDeletes; // Importa o trait SoftDeletes

class Doctor extends Model
{
    use HasFactory; // Habilita a criação de fábricas para o modelo

    use SoftDeletes; // Habilita exclusões suaves (soft deletes)

    public const TABLE_NAME = 'doctor'; // Define o nome da tabela

    public const PRIMARY_KEY = 'id'; // Define a chave primária

    public const FILLABLE = [ // Define os atributos preenchíveis
        'name',
        'specialty',
        'phone',
        'email',
    ];

    public $fillable = self::FILLABLE; // Atributo preenchível do modelo

    protected $primaryKey = self::PRIMARY_KEY; // Define a chave primária

    protected $table = self::TABLE_NAME; // Define o nome da tabela
}