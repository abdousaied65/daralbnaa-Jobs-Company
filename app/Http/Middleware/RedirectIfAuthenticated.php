<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            switch ($guard) {
                case 'supervisor-web':
                    return redirect(RouteServiceProvider::SUPERVISOR_HOME);
                case 'employee-web':
                    return redirect(RouteServiceProvider::EMPLOYEE_HOME);
            }
        }
        return $next($request);
    }
}
