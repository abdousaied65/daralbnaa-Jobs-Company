<?php

namespace App\Http\Controllers\Supervisor;

use App\Exports\DeptsExport;
use App\Models\Dept;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class DeptController extends Controller
{
    public function index(Request $request)
    {
        $data = Dept::query()->paginate('10');
        return view('supervisor.depts.index', compact('data'));
    }

    public function create()
    {
        return view('supervisor.depts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'dept_name_ar' => 'required',
            'dept_name_en' => 'required',
        ]);
        $input = $request->all();
        $dept = Dept::create($input);
        return redirect()->route('supervisor.depts.index')
            ->with('success', trans('main.dept_added'));
    }

    public function show($id)
    {
        $dept = Dept::findorfail($id);
        return view('supervisor.depts.show', compact('dept'));
    }


    public function edit($id)
    {
        $dept = Dept::findOrFail($id);
        return view('supervisor.depts.edit', compact('dept'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'dept_name_ar' => 'required',
            'dept_name_en' => 'required',
        ]);
        $input = $request->all();
        $dept = Dept::findOrFail($id);
        $dept->update($input);
        return redirect()->route('supervisor.depts.index')
            ->with('success', trans('main.dept_updated'));
    }

    public function destroy(Request $request)
    {
        Dept::findOrFail($request->dept_id)->delete();
        return redirect()->route('supervisor.depts.index')
            ->with('success', trans('main.dept_deleted'));
    }

    public function remove_selected(Request $request)
    {
        $depts_id = $request->depts;
        foreach ($depts_id as $dept_id) {
            $dept = Dept::FindOrFail($dept_id);
            $dept->delete();
        }
        return redirect()->route('supervisor.depts.index')
            ->with('success', trans('main.deleted'));
    }

    public function print_selected()
    {
        $depts = Dept::all();
        return view('supervisor.depts.print', compact('depts'));
    }

    public function export_depts_excel()
    {
        return Excel::download(new DeptsExport(), 'كل الاقسام والادارارت.xlsx');
    }
}
