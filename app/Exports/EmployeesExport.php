<?php

namespace App\Exports;
use App\Models\Dept;
use App\Models\Employee;
use App\Models\JobTitle;
use App\Models\Nationality;
use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeesExport implements FromCollection,WithHeadings
{
    public function collection()
    {
        $employees = Employee::select('name_ar','name_en', 'email','role_name','Status','phone_number','identity_number',
            'passport_number','job_number',
            'contract_period','dept_id','job_title_id','nationality_id','total_salary','weekend_vacation',
            'yearly_vacation','created_at')->get();
        $employees->transform(function($i){
            $i->dept_id = Dept::FindOrFail($i->dept_id)->dept_name_ar;
            $i->job_title_id = JobTitle::FindOrFail($i->job_title_id)->job_title_ar;
            $i->nationality_id = Nationality::FindOrFail($i->nationality_id)->nationality_ar;
            return $i;
        });
        return $employees;
    }
    public function headings(): array
    {
        return [
            'الاسم',
            'Name',
            'البريد الالكترونى',
            'الصلاحية',
            'الحالة',
            'رقم الجوال',
            'رقم الهوية',
            'رقم جواز السفر',
            'الرقم الوظيفى',
            'مدة العقد',
            'الادارة التابع لها',
            'المسمى الوظيفى',
            'الجنسية',
            'اجمالى الراتب',
            'الاجازة الاسبوعية',
            'الاجازة السنوية',
            'تاريخ الاضافة',
        ];
    }

}
