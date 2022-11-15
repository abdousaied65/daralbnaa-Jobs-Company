<?php

namespace App\Http\Controllers\Supervisor;

use App\Exports\EmployeeTransfersExport;
use App\Models\Dept;
use App\Models\Employee;
use App\Models\EmployeeTransfer;
use App\Http\Controllers\Controller;
use App\Models\JobTitle;
use App\Models\Nationality;
use App\Models\Project;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class EmployeeTransferController extends Controller
{
    public function index(Request $request)
    {
        $data = EmployeeTransfer::query()->paginate('10');
        $nationalities = Nationality::all();
        $employees = Employee::all();
        $depts = Dept::all();
        $job_titles = JobTitle::all();
        $projects = Project::all();
        return view('supervisor.employees_transfers.index', compact('data','employees','nationalities','depts','job_titles','projects'));
    }

    public function create()
    {
        $nationalities = Nationality::all();
        $depts = Dept::all();
        $job_titles = JobTitle::all();
        $projects = Project::all();
        $employees = Employee::all();
        return view('supervisor.employees_transfers.create',compact('nationalities','employees','depts','job_titles','projects'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'employee_id' => 'required',
            'old_dept_id' => 'required',
            'new_dept_id' => 'required',
            'old_project_id' => 'required',
            'new_project_id' => 'required',
            'date' => 'required',
            'status' => 'required',
        ]);
        $input = $request->all();
        $employee_transfer = EmployeeTransfer::create($input);
        if($request->status == "approved"){
            $employee = Employee::FindOrFail($request->employee_id);
            $employee->update([
                'dept_id' => $request->new_dept_id,
                'project_id' => $request->new_project_id,
            ]);
        }
        return redirect()->route('supervisor.employees_transfers.index')
            ->with('success', trans('main.employee_transfer_added'));
    }

    public function show($id)
    {
        $employee_transfer = EmployeeTransfer::findorfail($id);
        return view('supervisor.employees_transfers.show', compact('employee_transfer'));
    }


    public function edit($id)
    {
        $employee_transfer = EmployeeTransfer::findOrFail($id);
        $nationalities = Nationality::all();
        $depts = Dept::all();
        $job_titles = JobTitle::all();
        $projects = Project::all();
        $employees = Employee::all();
        return view('supervisor.employees_transfers.edit', compact('employee_transfer','employees','nationalities','depts','job_titles','projects'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'employee_id' => 'required',
            'old_dept_id' => 'required',
            'new_dept_id' => 'required',
            'old_project_id' => 'required',
            'new_project_id' => 'required',
            'date' => 'required',
            'status' => 'required',
        ]);
        $input = $request->all();
        $employee_transfer = EmployeeTransfer::findOrFail($id);
        $employee_transfer->update($input);
        if($request->status == "approved"){
            $employee = Employee::FindOrFail($request->employee_id);
            $employee->update([
                'dept_id' => $request->new_dept_id,
                'project_id' => $request->new_project_id,
            ]);
        }
        return redirect()->route('supervisor.employees_transfers.index')
            ->with('success', trans('main.employee_transfer_updated'));
    }

    public function destroy(Request $request)
    {
        EmployeeTransfer::findOrFail($request->employee_transfer_id)->delete();
        return redirect()->route('supervisor.employees_transfers.index')
            ->with('success', trans('main.employee_transfer_deleted'));
    }

    public function remove_selected(Request $request)
    {
        $employees_transfers_id = $request->employees_transfers;
        foreach ($employees_transfers_id as $employee_transfer_id) {
            $employee_transfer = EmployeeTransfer::FindOrFail($employee_transfer_id);
            $employee_transfer->delete();
        }
        return redirect()->route('supervisor.employees_transfers.index')
            ->with('success', trans('main.deleted'));
    }

    public function print_selected()
    {
        $employees_transfers = EmployeeTransfer::all();
        return view('supervisor.employees_transfers.print', compact('employees_transfers'));
    }

    public function export_employees_transfers_excel()
    {
        return Excel::download(new EmployeeTransfersExport(), 'كل طلبات نقل الموظفين.xlsx');
    }
}
