<?php

namespace App\Http\Controllers\Supervisor;

use App\Exports\EmployeesExport;
use App\Models\Dept;
use App\Models\Employee;
use App\Http\Controllers\Controller;
use App\Models\EmployeeCert;
use App\Models\JobTitle;
use App\Models\Nationality;
use App\Models\Project;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $data = Employee::query()->paginate('10');
        $nationalities = Nationality::all();
        $depts = Dept::all();
        $job_titles = JobTitle::all();
        $projects = Project::all();
        return view('supervisor.employees.index', compact('data', 'nationalities', 'depts', 'job_titles', 'projects'));
    }

    public function create()
    {
        abort(403);
//        $nationalities = Nationality::all();
//        $depts = Dept::all();
//        $job_titles = JobTitle::all();
//        $projects = Project::all();
//        return view('supervisor.employees.create', compact('nationalities', 'depts', 'job_titles', 'projects'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name_ar' => 'required',
            'name_en' => 'required',
            'password' => 'required|same:confirm-password',
            'role_name' => 'required',
            'phone_number' => 'required|unique:employees',
            'identity_number' => 'required|unique:employees',
            'contract_period' => 'required',
            'dept_id' => 'required',
            'project_id' => 'required',
            'job_title_id' => 'required',
            'nationality_id' => 'required',
            'total_salary' => 'required',
            'weekend_vacation' => 'required',
            'yearly_vacation' => 'required'
        ]);
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $nums = "0123456789";
        $job_number = substr(str_shuffle($nums), 0, 8);

        $input['job_number'] = $job_number;
        $employee = Employee::create($input);

        if ($request->hasFile('identity_file')) {
            $identity_file = $request->file('identity_file');
            $fileName = $identity_file->getClientOriginalName();
            $uploadDir = 'uploads/employees/identity_files/' . $employee->id;
            $identity_file->move($uploadDir, $fileName);
            $employee->identity_file = $uploadDir . '/' . $fileName;
            $employee->save();
        }

        if ($request->hasFile('cv_file')) {
            $cv_file = $request->file('cv_file');
            $fileName = $cv_file->getClientOriginalName();
            $uploadDir = 'uploads/employees/cv_files/' . $employee->id;
            $cv_file->move($uploadDir, $fileName);
            $employee->cv_file = $uploadDir . '/' . $fileName;
            $employee->save();
        }
        if ($request->hasfile('certs_files')) {
            $certs_files = array();
            foreach ($request->file('certs_files') as $file) {
                $cert_file = $file;
                $fileName = $cert_file->getClientOriginalName();
                $uploadDir = 'uploads/employees/certs_files/' . $employee->id;
                $cert_file->move($uploadDir, $fileName);

                $cert_file = $uploadDir . '/' . $fileName;
                array_push($certs_files,$cert_file);
            }

            $old_certs_files = EmployeeCert::where('employee_id',$employee->id)->get();
            if (!$old_certs_files->isEmpty()){
                foreach ($old_certs_files as $old_job_title){
                    $old_job_title->delete();
                }
            }

            foreach ($certs_files as $cert_file){
                $cert_file = EmployeeCert::create([
                    'employee_id' => $employee->id,
                    'cert_file' => $cert_file,
                ]);
            }
        }

        return redirect()->route('supervisor.employees.index')
            ->with('success', trans('main.employee_added'));
    }

    public function show($id)
    {
        $employee = Employee::findorfail($id);
        return view('supervisor.employees.show', compact('employee'));
    }


    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $nationalities = Nationality::all();
        $depts = Dept::all();
        $job_titles = JobTitle::all();
        $projects = Project::all();
        return view('supervisor.employees.edit', compact('employee', 'nationalities', 'depts', 'job_titles', 'projects'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name_ar' => 'required',
            'name_en' => 'required',
            'password' => 'same:confirm-password',
            'role_name' => 'required',
            'phone_number' => 'required',
            'identity_number' => 'required',
            'contract_period' => 'required',
            'dept_id' => 'required',
            'project_id' => 'required',
            'job_title_id' => 'required',
            'nationality_id' => 'required',
            'total_salary' => 'required',
            'weekend_vacation' => 'required',
            'yearly_vacation' => 'required'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = array_except($input, array('password'));
        }
        $employee = Employee::findOrFail($id);
        $employee->update($input);

        if ($request->hasFile('identity_file')) {
            $identity_file = $request->file('identity_file');
            $fileName = $identity_file->getClientOriginalName();
            $uploadDir = 'uploads/employees/identity_files/' . $employee->id;
            $identity_file->move($uploadDir, $fileName);
            $employee->identity_file = $uploadDir . '/' . $fileName;
            $employee->save();
        }

        if ($request->hasFile('cv_file')) {
            $cv_file = $request->file('cv_file');
            $fileName = $cv_file->getClientOriginalName();
            $uploadDir = 'uploads/employees/cv_files/' . $employee->id;
            $cv_file->move($uploadDir, $fileName);
            $employee->cv_file = $uploadDir . '/' . $fileName;
            $employee->save();
        }
        if ($request->hasfile('certs_files')) {
            $certs_files = array();
            foreach ($request->file('certs_files') as $file) {
                $cert_file = $file;
                $fileName = $cert_file->getClientOriginalName();
                $uploadDir = 'uploads/employees/certs_files/' . $employee->id;
                $cert_file->move($uploadDir, $fileName);

                $cert_file = $uploadDir . '/' . $fileName;
                array_push($certs_files,$cert_file);
            }

            $old_certs_files = EmployeeCert::where('employee_id',$employee->id)->get();
            if (!$old_certs_files->isEmpty()){
                foreach ($old_certs_files as $old_job_title){
                    $old_job_title->delete();
                }
            }

            foreach ($certs_files as $cert_file){
                $cert_file = EmployeeCert::create([
                    'employee_id' => $employee->id,
                    'cert_file' => $cert_file,
                ]);
            }
        }
        return redirect()->route('supervisor.employees.index')
            ->with('success', trans('main.employee_updated'));
    }

    public function destroy(Request $request)
    {
        Employee::findOrFail($request->employee_id)->delete();
        return redirect()->route('supervisor.employees.index')
            ->with('success', trans('main.employee_deleted'));
    }

    public function remove_selected(Request $request)
    {
        $employees_id = $request->employees;
        foreach ($employees_id as $employee_id) {
            $employee = Employee::FindOrFail($employee_id);
            $employee->delete();
        }
        return redirect()->route('supervisor.employees.index')
            ->with('success', trans('main.deleted'));
    }

    public function print_selected()
    {
        $employees = Employee::all();
        return view('supervisor.employees.print', compact('employees'));
    }

    public function export_employees_excel()
    {
        return Excel::download(new EmployeesExport(), 'كل الموظفين.xlsx');
    }
}
