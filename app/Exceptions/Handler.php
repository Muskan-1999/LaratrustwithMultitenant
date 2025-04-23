<?php
namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        $loginRoute = request()->getHost() === config('app.domain')
            ? route('login')
            : route('tenant.login');

        return $request->expectsJson()
            ? response()->json(['message' => $exception->getMessage()], 401)
            : redirect()->guest($loginRoute);
    }

}
?>