<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Auth\AuthenticationException;

class Authenticate extends Middleware
{
    protected function redirectTo($request, array $guards)
    {
        if (!$request->expectsJson()) {
            switch (current($guards)) {
                case 'supervisor-web':
                    return route('supervisor.login');
                    break;
                case 'employee-web':
                    return route('employee.login');
                    break;
            }
        }
    }

    protected function unauthenticated($request, array $guards)
    {
        throw new AuthenticationException(
            'Unauthenticated.', $guards, $this->redirectTo($request, $guards)
        );
    }
}
