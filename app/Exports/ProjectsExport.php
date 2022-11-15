<?php

namespace App\Exports;
use App\Models\Dept;
use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProjectsExport implements FromCollection,WithHeadings
{
    public function collection()
    {
        $projects = Project::select('project_name_ar','project_name_en','dept_id','added_date','project_end_date')->get();
        $projects->transform(function($i){
            $i->dept_id = Dept::FindOrFail($i->dept_id)->dept_name_ar;
            return $i;
        });
        return $projects;
    }
    public function headings(): array
    {
        return [
            'اسم المشروع','Project Name','الادارة التابع لها','تاريخ بداية المشروع','تاريخ انتهاء المشروع'
        ];
    }

}
