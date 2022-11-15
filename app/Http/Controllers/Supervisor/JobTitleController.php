<?php

namespace App\Http\Controllers\Supervisor;

use App\Exports\JobTitlesExport;
use App\Models\Dept;
use App\Models\JobTitle;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class JobTitleController extends Controller
{
    public function index(Request $request)
    {
        $data = JobTitle::query()->paginate('10');
        $depts = Dept::all();
        return view('supervisor.job_titles.index', compact('data','depts'));
    }

    public function create()
    {
        $depts = Dept::all();
        return view('supervisor.job_titles.create',compact('depts'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'job_title_ar' => 'required',
            'job_title_en' => 'required',
            'dept_id' => 'required',
        ]);
        $input = $request->all();
        $job_title = JobTitle::create($input);
        return redirect()->route('supervisor.job_titles.index')
            ->with('success', trans('main.job_title_added'));
    }

    public function show($id)
    {
        $job_title = JobTitle::findorfail($id);
        return view('supervisor.job_titles.show', compact('job_title'));
    }


    public function edit($id)
    {
        $job_title = JobTitle::findOrFail($id);
        $depts = Dept::all();
        return view('supervisor.job_titles.edit', compact('job_title','depts'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'job_title_ar' => 'required',
            'job_title_en' => 'required',
            'dept_id' => 'required'
        ]);
        $input = $request->all();
        $job_title = JobTitle::findOrFail($id);
        $job_title->update($input);
        return redirect()->route('supervisor.job_titles.index')
            ->with('success', trans('main.job_title_updated'));
    }

    public function destroy(Request $request)
    {
        JobTitle::findOrFail($request->job_title_id)->delete();
        return redirect()->route('supervisor.job_titles.index')
            ->with('success', trans('main.job_title_deleted'));
    }

    public function remove_selected(Request $request)
    {
        $job_titles_id = $request->job_titles;
        foreach ($job_titles_id as $job_title_id) {
            $job_title = JobTitle::FindOrFail($job_title_id);
            $job_title->delete();
        }
        return redirect()->route('supervisor.job_titles.index')
            ->with('success', trans('main.deleted'));
    }

    public function print_selected()
    {
        $job_titles = JobTitle::all();
        return view('supervisor.job_titles.print', compact('job_titles'));
    }

    public function export_job_titles_excel()
    {
        return Excel::download(new JobTitlesExport(), 'المسميات الوظيفية.xlsx');
    }
}
