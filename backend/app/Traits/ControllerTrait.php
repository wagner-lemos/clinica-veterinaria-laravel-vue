<?php
declare(strict_types=1); // Habilita a verificação de tipos estritos

namespace App\Traits;

use Illuminate\Http\JsonResponse; // Utilizada para retornar respostas JSON
use Illuminate\Http\Response; // Fornece constantes para os códigos de resposta HTTP
use Illuminate\Http\Request; // Representa a requisição HTTP
use Illuminate\Support\Facades\Validator; // Validador para validar dados da requisição

/**
 * Trait que fornece métodos reutilizáveis para CRUD em controladores.
 * A trait depende de um repositório (repository) para realizar as operações.
 */
trait ControllerTrait
{
    /**
     * Retorna uma listagem de recursos.
     *
     * @param Request $request - Requisição HTTP com os dados da busca
     * @return JsonResponse - Retorna uma resposta JSON com os dados ou erro
     */
    public function index(Request $request)
    {
        try {
            // Verifica se a propriedade 'repository' está definida
            if (!empty($this->repository)) {
                // Chama o método 'index' no repositório e retorna os dados
                return response()->json([$this->repository->index($request->all())])
                    ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
            }
        } catch (\Exception $exception) {
            // Retorna a mensagem de erro com o status 404 (Not Found)
            return response()->json($exception->getMessage())
                ->setStatusCode(Response::HTTP_NOT_FOUND, Response::$statusTexts[Response::HTTP_NOT_FOUND]);
        }
    }

    /**
     * Armazena um novo recurso.
     *
     * @param Request $request - Requisição HTTP com os dados do recurso
     * @return JsonResponse - Retorna uma resposta JSON com o recurso criado ou erro
     */
    public function store(Request $request)
    {
        // Valida os dados recebidos com as regras especificadas na propriedade 'validators'
        $validator = Validator::make($request->all(), $this->validators);
        if ($validator->fails()) {
            // Se a validação falhar, retorna os erros com status 400 (Bad Request)
            return response()->json([$validator->errors()])
                ->setStatusCode(Response::HTTP_BAD_REQUEST, Response::$statusTexts[Response::HTTP_BAD_REQUEST]);
        }

        try {
            if (!empty($this->repository)) {
                // Chama o método 'store' no repositório para criar um novo recurso
                $returnInsert = $this->repository->store($request->all());
                return response()->json([$returnInsert])
                    ->setStatusCode(Response::HTTP_CREATED, Response::$statusTexts[Response::HTTP_CREATED]);
            }
        } catch (\Exception $exception) {
            // Retorna a mensagem de erro com status 404 (Not Found)
            return response()->json($exception->getMessage())
                ->setStatusCode(Response::HTTP_NOT_FOUND, Response::$statusTexts[Response::HTTP_NOT_FOUND]);
        }
    }

    /**
     * Exibe um recurso específico.
     *
     * @param int $id - ID do recurso
     * @return JsonResponse - Retorna uma resposta JSON com o recurso ou erro
     */
    public function show(int $id)
    {
        try {
            if (!empty($this->repository)) {
                // Chama o método 'getById' no repositório para buscar o recurso pelo ID
                $returnShow = $this->repository->getById($id);
            }
            // Retorna o recurso encontrado com status 204 (No Content)
            return response()->json([$returnShow])
                ->setStatusCode(Response::HTTP_NO_CONTENT, Response::$statusTexts[Response::HTTP_NO_CONTENT]);
        } catch (\Exception $exception) {
            // Retorna a mensagem de erro com status 404 (Not Found)
            return response()->json($exception->getMessage())
                ->setStatusCode(Response::HTTP_NOT_FOUND, Response::$statusTexts[Response::HTTP_NOT_FOUND]);
        }
    }

    /**
     * Atualiza um recurso existente.
     *
     * @param Request $request - Requisição HTTP com os dados do recurso
     * @param int $id - ID do recurso a ser atualizado
     * @return JsonResponse - Retorna uma resposta JSON com o recurso atualizado ou erro
     */
    public function update(Request $request, int $id)
    {
        try {
            if (!empty($this->repository)) {
                // Chama o método 'update' no repositório para atualizar o recurso
                $returnUpdate = $this->repository->update($request->all(), $id);
                return response()->json([$returnUpdate])
                    ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
            }
        } catch (\Exception $exception) {
            // Retorna a mensagem de erro com status 404 (Not Found)
            return response()->json($exception->getMessage())
                ->setStatusCode(Response::HTTP_NOT_FOUND, Response::$statusTexts[Response::HTTP_NOT_FOUND]);
        }
    }

    /**
     * Remove um recurso específico.
     *
     * @param int $id - ID do recurso a ser removido
     * @return JsonResponse - Retorna uma resposta JSON confirmando a remoção ou erro
     */
    public function destroy(int $id)
    {
        try {
            if (!empty($this->repository)) {
                // Chama o método 'destroy' no repositório para excluir o recurso
                $returnDestroy = $this->repository->destroy($id);
                return response()->json([$returnDestroy])
                    ->setStatusCode(Response::HTTP_NO_CONTENT, Response::$statusTexts[Response::HTTP_NO_CONTENT]);
            }
        } catch (\Exception $exception) {
            // Retorna a mensagem de erro com status 404 (Not Found)
            return response()->json($exception->getMessage())
                ->setStatusCode(Response::HTTP_NOT_FOUND, Response::$statusTexts[Response::HTTP_NOT_FOUND]);
        }
    }
}