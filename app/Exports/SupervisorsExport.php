<?php

namespace App\Exports;
use App\Models\Dept;
use App\Models\JobTitle;
use App\Models\Supervisor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SupervisorsExport implements FromCollection,WithHeadings
{
    public function collection()
    {
        $supervisors = Supervisor::select('supervisor_name_ar','supervisor_name_en','email','phone_number','role_name','dept_id','job_title_id','created_at')->get();
        $supervisors->transform(function($i){
            if(!empty($i->dept_id)){
                $i->dept_id = Dept::FindOrFail($i->dept_id)->dept_name_ar;
            }
            if(!empty($i->job_title_id)){
                $i->job_title_id = JobTitle::FindOrFail($i->job_title_id)->job_title_ar;
            }
            return $i;
        });
        return $supervisors;
    }
    public function headings(): array
    {
        return [
            'الاسم باللغة العربية',
            'الاسم باللغة الانجليزية',
            'البريد الالكترونى',
            'رقم الجوال',
            'صلاحية المدير',
            'الادارة التابع لها',
            'المسمى الوظيفى',
            'تاريخ الاضافة'
        ];
    }

}
