<?php
declare(strict_types=1); // Habilita a verificação de tipos estritos

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller; // Importa a classe base Controller
use Illuminate\Http\Request; // Importa a classe Request para lidar com requisições HTTP
use Illuminate\Http\JsonResponse; // Utilizada para retornar respostas JSON
use Illuminate\Http\Response; // Contém constantes e métodos para lidar com respostas HTTP
use Illuminate\Support\Facades\Validator; // Importa o validador para validar os dados da requisição

/**
 * Controlador responsável pela autenticação de usuários no sistema.
 * Ele contém métodos para login, logout e obtenção de informações do usuário autenticado.
 */
class LoginController extends Controller
{
    /**
     * Método responsável pelo login de usuários.
     *
     * @param Request $request - Requisição HTTP contendo os dados de login
     * @return JsonResponse - Retorna uma resposta JSON com o token ou erro
     */
    public function login(Request $request)
    {
        // Validação dos dados de login
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email', // O email é obrigatório, deve ser uma string e válido
            'password' => 'required|string', // A senha é obrigatória e deve ser uma string
        ]);

        // Se a validação falhar, retorna os erros com status 422 (Unprocessable Entity)
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Coleta os dados de login (email e senha) da requisição
        $credentials = $request->only('email', 'password');

        // Verifica se as credenciais são válidas usando o método attempt do Laravel
        if (!auth()->attempt($credentials)) {
            return response()->json([
                'message' => 'Acesso não autorizado!', // Mensagem de erro de login
                'statusTexts' => Response::$statusTexts[Response::HTTP_UNAUTHORIZED], // Texto descritivo do status HTTP
                'status' => Response::HTTP_UNAUTHORIZED // Código de status HTTP 401 (Unauthorized)
            ])->setStatusCode(Response::HTTP_UNAUTHORIZED, Response::$statusTexts[Response::HTTP_UNAUTHORIZED]);
        }

        // Gera um token de autenticação se o login for bem-sucedido
        $token = auth()->user()->createToken('auth_token');

        // Retorna o token e tipo de autenticação em resposta JSON
        return response()->json([
            'message' => 'Login autenticado com sucesso!',
            'data' => [
                'token' => $token->plainTextToken, // Token gerado
                'token_type' => 'Bearer', // Tipo do token
            ],
        ], Response::HTTP_OK); // Retorna com status 200 (OK)
    }

    /**
     * Método para obter os dados do usuário autenticado.
     *
     * @param Request $request - A requisição HTTP
     * @return JsonResponse - Retorna os dados do usuário autenticado
     */
    public function user(Request $request)
    {
        // Obtém o usuário autenticado
        $user = auth()->user();

        // Retorna os dados do usuário em resposta JSON
        return response()->json($user, 200);
    }

    /**
     * Método para realizar o logout do usuário.
     * Remove o token de autenticação do usuário atual.
     *
     * @return JsonResponse - Retorna uma resposta vazia com status 204 (No Content)
     */
    public function logout()
    {
        // Remove o token de acesso atual do usuário
        auth()->user()->currentAccessToken()->delete();

        // Retorna uma resposta vazia com status 204 (No Content)
        return response()->json([], 204);
    }
}
