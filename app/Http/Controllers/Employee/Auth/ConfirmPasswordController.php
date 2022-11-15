<?php

namespace App\Http\Controllers\Employee\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ConfirmsPasswords;

class ConfirmPasswordController extends Controller
{
    use ConfirmsPasswords;
    protected $redirectTo = RouteServiceProvider::EMPLOYEE_HOME;
    public function __construct()
    {
        $this->middleware('auth:employee-web');
    }
    public function showConfirmForm()
    {
        return view('employee.auth.passwords.confirm');
    }
}
