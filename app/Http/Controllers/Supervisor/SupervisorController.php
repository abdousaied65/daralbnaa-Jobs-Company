<?php

namespace App\Http\Controllers\Supervisor;

use App\Exports\SupervisorsExport;
use App\Models\Dept;
use App\Models\JobTitle;
use App\Models\Project;
use App\Models\Supervisor;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    public function edit_profile($id)
    {
        $user = Supervisor::findOrFail($id);
        return view('supervisor.profiles.edit', compact('user'));
    }

    public function update_profile(Request $request, $id)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'same:confirm-password'
        ]);
        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = array_except($input, array('password'));
        }
        $user = Supervisor::findOrFail($id);
        $user->update($input);
        if ($request->hasFile('profile_pic')) {
            $profile_pic = $request->file('profile_pic');
            $fileName = $profile_pic->getClientOriginalName();
            $uploadDir = 'uploads/profiles/supervisors/' . $id;
            $profile_pic->move($uploadDir, $fileName);
            $user->profile_pic = $uploadDir . '/' . $fileName;
            $user->save();
        }
        return redirect()->back()->with('success', trans('main.profile_info_updated'));
    }


    public function index(Request $request)
    {
        $data = Supervisor::query()->paginate('10');
        $roles = Role::get()->pluck('name', 'name');
        $depts = Dept::all();
        $job_titles = JobTitle::all();
        $projects = Project::all();
        return view('supervisor.supervisors.index', compact('data', 'job_titles', 'roles', 'depts', 'projects'));
    }

    public function create()
    {
        $roles = Role::where('guard_name', 'supervisor-web')
            ->get()->pluck('name', 'name');
        $depts = Dept::all();
        $job_titles = JobTitle::all();
        $projects = Project::all();
        return view('supervisor.supervisors.create', compact('roles', 'job_titles', 'depts', 'projects'));

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'supervisor_name_ar' => 'required',
            'supervisor_name_en' => 'required',
            'email' => 'required|email',
            'password' => 'required|same:confirm-password',
            'role_name' => 'required',
            'dept_id' => 'required',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $supervisor = Supervisor::create($input);
        $supervisor->assignRole($request->input('role_name'));
        if ($request->hasFile('profile_pic')) {
            $image = $request->file('profile_pic');
            $fileName = $image->getClientOriginalName();
            $uploadDir = 'uploads/profiles/supervisors/' . $supervisor->id;
            $image->move($uploadDir, $fileName);
            $supervisor->profile_pic = $uploadDir . '/' . $fileName;
            $supervisor->save();
        }
        $supervisor->projects()->syncWithoutDetaching($request->projects);

        return redirect()->route('supervisor.supervisors.index')
            ->with('success', trans('main.supervisor_added'));
    }

    public function show($id)
    {
        $supervisor = Supervisor::findorfail($id);
        return view('supervisor.supervisors.show', compact('supervisor'));
    }


    public function edit($id)
    {
        $supervisor = Supervisor::findOrFail($id);
        $roles = Role::where('guard_name', 'supervisor-web')
            ->get()->pluck('name', 'name');
        $supervisorRole = $supervisor->roles->pluck('name', 'name')->all();
        $depts = Dept::all();
        $job_titles = JobTitle::all();
        $projects = Project::all();
        return view('supervisor.supervisors.edit', compact('supervisor', 'job_titles', 'depts', 'projects', 'roles', 'supervisorRole'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'supervisor_name_ar' => 'required',
            'supervisor_name_en' => 'required',
            'email' => 'required|email',
            'password' => 'same:confirm-password',
            'role_name' => 'required',
            'dept_id' => 'required',
        ]);
        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = array_except($input, array('password'));
        }
        $supervisor = Supervisor::findOrFail($id);
        $supervisor->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $supervisor->assignRole($request->input('role_name'));
        if ($request->hasFile('profile_pic')) {
            $image = $request->file('profile_pic');
            $fileName = $image->getClientOriginalName();
            $uploadDir = 'uploads/profiles/supervisors/' . $supervisor->id;
            $image->move($uploadDir, $fileName);
            $supervisor->profile_pic = $uploadDir . '/' . $fileName;
            $supervisor->save();
        }
        return redirect()->route('supervisor.supervisors.index')
            ->with('success', trans('main.supervisor_updated'));
    }

    public function destroy(Request $request)
    {
        Supervisor::findOrFail($request->supervisor_id)->delete();
        return redirect()->route('supervisor.supervisors.index')
            ->with('success', trans('main.supervisor_deleted'));
    }

    public function remove_selected(Request $request)
    {
        $supervisors_id = $request->supervisors;
        foreach ($supervisors_id as $supervisor_id) {
            $supervisor = Supervisor::FindOrFail($supervisor_id);
            $supervisor->delete();
        }
        return redirect()->route('supervisor.supervisors.index')
            ->with('success', trans('main.deleted'));
    }

    public function print_selected()
    {
        $supervisors = Supervisor::all();
        return view('supervisor.supervisors.print', compact('supervisors'));
    }

    public function export_supervisors_excel()
    {
        return Excel::download(new SupervisorsExport(), 'كل المدراء.xlsx');
    }

    public function show_projects(Request $request)
    {
        $dept_id = $request->dept_id;
        $dept = Dept::FindOrFail($dept_id);
        $projects = $dept->projects;
        foreach ($projects as $project) {
            if (App::getLocale() == "ar") {
                echo "<option value='" . $project->id . "'>" . $project->project_name_ar . "</option>";
            } else {
                echo "<option value='" . $project->id . "'>" . $project->project_name_en . "</option>";
            }
        }
    }

    public function show_job_titles(Request $request)
    {
        $dept_id = $request->dept_id;
        $dept = Dept::FindOrFail($dept_id);
        $job_titles = $dept->job_titles;
        foreach ($job_titles as $job_title) {
            if (App::getLocale() == "ar") {
                echo "<option value='" . $job_title->id . "'>" . $job_title->job_title_ar . "</option>";
            } else {
                echo "<option value='" . $job_title->id . "'>" . $job_title->job_title_en . "</option>";
            }
        }
    }
}
