<?php

namespace App\Exceptions;

use App\Traits\TraitException;
use HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;

class Handler extends ExceptionHandler
{

    use TraitException;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
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
        if ($exception instanceof MethodNotAllowedHttpException) {
            return $this->fail($exception->getMessage(), [], JsonResponse::HTTP_METHOD_NOT_ALLOWED);
        }

        if ($exception instanceof NotFoundHttpException) {
            return $this->fail(__('global.404'), [], JsonResponse::HTTP_NOT_FOUND);
        }

        if ($exception instanceof HttpException) {
            return $this->fail($exception->getMessage(), [], $exception->getStatusCode());
        }

        if (!empty($exception) && config('app.debug'))
            return $this->apiException($exception);

        return response()->json($exception, 500);
    }
}
