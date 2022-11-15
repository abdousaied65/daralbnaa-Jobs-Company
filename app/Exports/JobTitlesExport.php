<?php

namespace App\Exports;
use App\Models\Dept;
use App\Models\JobTitle;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class JobTitlesExport implements FromCollection,WithHeadings
{
    public function collection()
    {
        $job_titles = JobTitle::select('job_title_ar','job_title_en','dept_id','rank','created_at')->get();
        $job_titles->transform(function($i){
                $i->dept_id = Dept::FindOrFail($i->dept_id)->dept_name_ar;
                return $i;
            });
        return $job_titles;
    }
    public function headings(): array
    {
        return [
            'المسمى الوظيفى','Job Title','الادارة','التدرج الوظيفى','تاريخ الاضافة'
        ];
    }

}
