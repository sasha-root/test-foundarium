<?php declare(strict_types=1);

namespace Api\Domain\Common\Middleware;

use Api\Domain\Common\Exception\DomainException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Illuminate\Http\Request;
use Closure;
use Illuminate\Http\JsonResponse;

class ApiExceptionRenderMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        /** @var JsonResponse $response */
        $response = $next($request);
        $e = $response->exception;
        if ($e instanceof \Throwable) {
            $status = ResponseAlias::HTTP_BAD_REQUEST;
            if ($e instanceof DomainException) {
                $status = $e->getCode();
            } elseif ($e instanceof ModelNotFoundException) {
                $status = ResponseAlias::HTTP_NOT_FOUND;
            } elseif ($e instanceof ValidationException) {
                $status = ResponseAlias::HTTP_UNPROCESSABLE_ENTITY;
            }
            return $this->renderJsonErrorFromException($e, $status);
        }

        if ($response instanceof JsonResponse) {
            if (!is_null($content = $response->getContent())) {
                $response->setContent(json_encode(['data' => json_decode($content, true)]));
            }
        }

        return $response;
    }

    protected function renderJsonErrorFromException(\Throwable $e, int $status): JsonResponse
    {
        if ($e instanceof ValidationException) {
            /** @var ValidationException $ve */
            $ve = $e;
            $data = [
                'data' => null,
                'status' => $status,
                'message' => $e->getMessage(),
                'errors' => $ve->errors()
            ];
        } else {
            $data = [
                'data' => null,
                'errors' => [
                    'status' => $status,
                    'message' => $e->getMessage(),
                    'trace' => (env('APP_DEBUG', 'true') == true) ? $e->getTraceAsString() : null
                ]
            ];
        }

        return response()->json($data, $status)
            ->header('Content-Type', 'application/json')
            ->header('Access-Control-Allow-Origin', '*')
            ->setEncodingOptions(JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }
}
