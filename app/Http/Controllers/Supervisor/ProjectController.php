<?php

namespace App\Http\Controllers\Supervisor;

use App\Exports\ProjectsExport;
use App\Models\Dept;
use App\Models\Project;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $data = Project::query()->paginate('10');
        $depts = Dept::all();
        return view('supervisor.projects.index', compact('data','depts'));
    }

    public function create()
    {
        $depts = Dept::all();
        return view('supervisor.projects.create',compact('depts'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'project_name_ar' => 'required',
            'project_name_en' => 'required',
            'dept_id' => 'required',
            'added_date' => 'required',
            'project_end_date' => 'required'
        ]);
        $input = $request->all();
        $project = Project::create($input);
        return redirect()->route('supervisor.projects.index')
            ->with('success', trans('main.project_added'));
    }

    public function show($id)
    {
        $project = Project::findorfail($id);
        return view('supervisor.projects.show', compact('project'));
    }


    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $depts = Dept::all();
        return view('supervisor.projects.edit', compact('project','depts'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'project_name_ar' => 'required',
            'project_name_en' => 'required',
            'dept_id' => 'required',
            'added_date' => 'required',
            'project_end_date' => 'required'
        ]);
        $input = $request->all();
        $project = Project::findOrFail($id);
        $project->update($input);
        return redirect()->route('supervisor.projects.index')
            ->with('success', trans('main.project_updated'));
    }

    public function destroy(Request $request)
    {
        Project::findOrFail($request->project_id)->delete();
        return redirect()->route('supervisor.projects.index')
            ->with('success', trans('main.project_deleted'));
    }

    public function remove_selected(Request $request)
    {
        $projects_id = $request->projects;
        foreach ($projects_id as $project_id) {
            $project = Project::FindOrFail($project_id);
            $project->delete();
        }
        return redirect()->route('supervisor.projects.index')
            ->with('success', trans('main.deleted'));
    }

    public function print_selected()
    {
        $projects = Project::all();
        return view('supervisor.projects.print', compact('projects'));
    }

    public function export_projects_excel()
    {
        return Excel::download(new ProjectsExport(), 'كل المشاريع.xlsx');
    }
}
