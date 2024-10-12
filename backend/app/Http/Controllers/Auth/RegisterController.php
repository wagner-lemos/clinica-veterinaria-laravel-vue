<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller; // Importa a classe base Controller
use App\Models\User; // Importa o modelo User
use Illuminate\Http\Request; // Importa a classe Request para lidar com requisições HTTP
use Illuminate\Support\Facades\Validator; // Importa o validador para validar dados de entrada

/**
 * Controlador responsável pelo registro de novos usuários na aplicação.
 * Este controlador trata a lógica de cadastro de usuários com base nas permissões
 * e validações necessárias. Ele verifica os dados recebidos e cria um novo registro
 * de usuário, atribuindo um nível de acesso (recepcionista ou médico).
 */
class RegisterController extends Controller
{
    /**
     * Método responsável por registrar um novo usuário.
     *
     * @param Request $request - Requisição HTTP contendo os dados de registro
     * @param User $user - Instância do modelo User para realizar operações no banco de dados
     * @return \Illuminate\Http\JsonResponse - Retorna um JSON com os dados do usuário cadastrado ou erros
     */
    public function register(Request $request, User $user)
    {
        // Validação dos dados da requisição
        $validator = Validator::make($request->all(), [
            'name' => 'required|string', // O nome é obrigatório e deve ser uma string
            'email' => 'required|string|email', // O email é obrigatório, deve ser uma string e um email válido
            'password' => 'required|string', // A senha é obrigatória e deve ser uma string
            'access_level' => 'required|string|in:recepcionista,medico', // O nível de acesso deve ser 'recepcionista' ou 'medico'
        ]);

        // Se a validação falhar, retorna os erros com status 422 (Unprocessable Entity)
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Coleta apenas os dados necessários do request
        $registerData = $request->only('name', 'email', 'password', 'access_level');

        // Criptografa a senha antes de salvar no banco de dados
        $registerData['password'] = bcrypt($registerData['password']);

        // Tenta criar o novo usuário no banco de dados. Caso falhe, retorna erro 500
        if (!$user = $user->create($registerData)) {
            abort(500, 'Erro ao cadastrar novo usuário!');
        }

        // Retorna os dados do usuário recém-criado em formato JSON
        return response()->json([
            'data' => [
                'user' => $user
            ]
        ]);
    }
}