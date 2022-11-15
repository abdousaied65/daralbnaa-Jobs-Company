<?php

namespace App\Http\Controllers\Supervisor\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Response;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::SUPERVISOR_HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest:supervisor-web')->except('logout');
    }

    protected function loggedOut(Request $request)
    {
        return $request->wantsJson()
            ? new Response('', 204)
            : redirect(LaravelLocalization::setLocale().'/supervisor');
    }

    protected function guard()
    {
        return Auth::guard('supervisor-web');
    }

    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    public function showLoginForm() {
        if (Auth::guard('employee-web')->check()) {
            return redirect()->route('employee.home');
        }
        elseif (Auth::guard('supervisor-web')->check()) {
            return redirect()->route('supervisor.home');
        }
        elseif (Auth::guard('web')->check()) {
            return redirect()->route('supervisor.home');
        }
        else{
            return view('supervisor.auth.login');
        }
    }
    public function username()
    {
        return 'phone_number';
    }
}
