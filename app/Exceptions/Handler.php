<?php

namespace App\Exceptions;

use App\Builder\ReturnApi;
use BadMethodCallException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof BadMethodCallException) {
            return ReturnApi::error('Método errado chamado', null, 500);
        }

        if ($exception instanceof NotFoundHttpException) {
            return ReturnApi::error('Rota não encontrada', null, 404);
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return ReturnApi::error('Método não suportado nesta rota', null, 404);
        }

        if ($exception instanceof ValidationException) {
            return parent::render($request, $exception);
        }

        return ReturnApi::error("Erro inesperado na API", null, 500);

    }
}
