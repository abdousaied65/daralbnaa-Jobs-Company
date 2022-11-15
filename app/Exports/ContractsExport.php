<?php

namespace App\Exports;
use App\Models\Application;
use App\Models\Contract;
use App\Models\JobTitle;
use App\Models\Nationality;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ContractsExport implements FromCollection,WithHeadings
{
    public function collection()
    {
        $contracts = Contract::select('application_id','date',
            'employee_name','nationality_id','identity_number','passport_number','employee_address',
            'phone_number','another_phone_number','email','job_title_id','contract_period',
            'start_date','end_date','basic_salary',
            'housing_allowance','transport_allowance',
            'another_allowance','total_salary','status','notes','created_at')->get();
        $contracts->transform(function($i){
            $i->nationality_id = Nationality::FindOrFail($i->nationality_id)->nationality_ar;
            $i->job_title_id = JobTitle::FindOrFail($i->job_title_id)->job_title_ar;
            $i->application_id = trans('main.'.Application::FindOrFail($i->application_id)->application_type.'');
            $i->status = trans('main.'.$i->status.'');
            return $i;
        });
        return $contracts;
    }
    public function headings(): array
    {
        return [
            'طلب التوظيف',
            'التاريخ',
            'اسم الموظف',
            'الجنسية',
            'رقم الهوية',
            'رقم جواز السفر',
            'عنوان الموظف',
            'رقم الجوال','رقم جوال اخر',
            'البريد الالكترونى',
            'المسمى الوظيفى',
            'مدة العقد بالسنة',
            'بداية العقد','نهاية العقد',
            'اساسى الراتب',
            'بدل سكن',
            'بدل نقل',
            'بدلات اخرى',
            'اجمالى الراتب',
            'الحالة',
            'ملاحظات',
            'تاريخ الاضافة',
        ];
    }

}
