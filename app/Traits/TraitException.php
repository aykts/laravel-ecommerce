<?php
/**
 * Created by PhpStorm.
 * User: AykutPC
 * Date: 21.8.2020
 * Time: 10:34
 */

namespace App\Traits;

use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

trait TraitException
{

    use TraitApiResponser;

    public function apiException($e)
    {
        if ($this->isModel($e)) {

            return $this->fail('404 Not Found (' . $e->getModel() . ')', [], JsonResponse::HTTP_NOT_FOUND);

        } elseif ($this->RouteNotFound($e)) {

            return $this->fail($e->getMessage(), [], JsonResponse::HTTP_UNAUTHORIZED);

        } elseif ($this->isValidate($e)) {

            return $this->fail($e->validator->getData(), [], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);

        } elseif ($this->isQuery($e)) {

            $errorMessage = ($e->errorInfo == null) ? $e->getMessage() : end($e->errorInfo);
            return $this->fail($errorMessage, $e->validator->getData(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY);

        } else {

            return $this->fail($e->getMessage());

        }

    }

    protected function isModel($e)
    {
        return $e instanceof ModelNotFoundException;
    }

    protected function RouteNotFound($e)
    {
        return $e instanceof RouteNotFoundException;
    }

    protected function isValidate($e)
    {
        return $e instanceof ValidationException;
    }

    protected function isQuery($e)
    {
        return $e instanceof QueryException;
    }
}
