<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Importa o trait HasFactory para permitir a criação de factories
use Illuminate\Foundation\Auth\User as Authenticatable; // Extende a classe base Authenticatable para autenticação
use Illuminate\Notifications\Notifiable; // Importa o trait Notifiable para notificações
use Laravel\Sanctum\HasApiTokens; // Importa o trait HasApiTokens para suporte a tokens API

class User extends Authenticatable // Define a classe User como um modelo que estende Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable; // Usa os traits HasApiTokens, HasFactory e Notifiable

    /**
     * Os atributos que podem ser atribuídos em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',          // Nome do usuário
        'email',         // Email do usuário
        'password',      // Senha do usuário
        'access_level',  // Nível de acesso -> usuário (recepcionista, médico, etc.)
    ];

    /**
     * Os atributos que devem ser ocultados durante a serialização.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',      // Senha do usuário (não deve ser exposta)
        'remember_token', // Token de lembrança (usado para autenticação)
    ];

    /**
     * Os atributos que devem ser convertidos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime', // Converte o campo email_verified_at para um objeto datetime
        'password' => 'hashed', // Indica que a senha deve ser tratada como um hash
    ];
}