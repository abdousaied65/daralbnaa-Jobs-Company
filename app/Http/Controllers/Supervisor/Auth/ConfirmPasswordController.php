<?php

namespace App\Http\Controllers\Supervisor\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ConfirmsPasswords;

class ConfirmPasswordController extends Controller
{
    use ConfirmsPasswords;
    protected $redirectTo = RouteServiceProvider::SUPERVISOR_HOME;
    public function __construct()
    {
        $this->middleware('auth:supervisor-web');
    }
    public function showConfirmForm()
    {
        return view('supervisor.auth.passwords.confirm');
    }
}
