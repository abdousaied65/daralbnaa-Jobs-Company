<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:employee-web');
    }
    public function index()
    {
        $auth_id = Auth::user()->id;
        $user = Employee::findOrFail($auth_id);
        return view('employee.home', compact('user'));
    }
    public function lock_screen(){
        return view('employee.lockscreen');
    }
    public function personal_data($id){
        $employee = Employee::FindOrFail($id);
        return view('employee.personal_data.view',compact('employee'));
    }
}
