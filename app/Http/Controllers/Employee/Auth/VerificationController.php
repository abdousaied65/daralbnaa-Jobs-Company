<?php
namespace App\Http\Controllers\Employee\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    use VerifiesEmails;
    protected $redirectTo = RouteServiceProvider::EMPLOYEE_HOME;
    public function __construct()
    {
        $this->middleware('auth:employee-web');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
    public function show(Request $request)
    {
        return $request->user('employee-web')->hasVerifiedEmail()
            ? redirect($this->redirectPath())
            : view('employee.auth.verify');
    }
}
