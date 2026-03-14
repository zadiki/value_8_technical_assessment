<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $exception)
    {
        // Always return JSON for API requests
        return response()->json([
            'success' => false,
            'message' => $exception->getMessage(),
            'error' => class_basename($exception),
        ], $this->getStatusCode($exception));
    }

    protected function getStatusCode(Throwable $exception)
    {
        return method_exists($exception, 'getStatusCode')
            ? $exception->getStatusCode()
            : 500;
    }
}
