<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Contract;
use App\Models\Employee;
use App\Models\Offer;
use App\Models\Supervisor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:supervisor-web');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        $auth_id = Auth::user()->id;
        $user = Supervisor::findOrFail($auth_id);
        $supervisors = Supervisor::all();
        $employees = Employee::all();
        $offers = Offer::all();
        $applications = Application::all();
        $contracts = Contract::all();
        return view('supervisor.home', compact('user','offers','applications','contracts','supervisors','employees'));
    }
    public function lock_screen(){
        return view('supervisor.lockscreen');
    }
}
