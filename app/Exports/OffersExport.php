<?php

namespace App\Exports;
use App\Models\JobTitle;
use App\Models\Nationality;
use App\Models\Offer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OffersExport implements FromCollection,WithHeadings
{
    public function collection()
    {
        $offers = Offer::select('employee_name','phone_number','nationality_id','basic_salary',
            'housing_allowance','transport_allowance','another_allowance','total_salary','weekend_vacation','yearly_vacation',
            'contract_period','job_title_id','expired_at','employee_response','created_at')->get();
        $offers->transform(function($i){
            $i->job_title_id = JobTitle::FindOrFail($i->job_title_id)->job_title_ar;
            $i->nationality_id = Nationality::FindOrFail($i->nationality_id)->nationality_ar;
            $i->employee_response = trans('main.'.$i->employee_response.'');
            return $i;
        });
        return $offers;
    }
    public function headings(): array
    {
        return [
            'الاسم',
            'رقم الجوال',
            'الجنسية',
            'اساسى الراتب',
            'بدل سكن',
            'بدل نقل',
            'بدلات اخرى',
            'اجمالى الراتب',
            'الاجازة الاسبوعية',
            'الاجازة السنوية',
            'مدة العقد',
            'المسمى الوظيفى',
            'ينتهى فى',
            'الرد على العرض الوظيفى',
            'تاريخ الاضافة',
        ];
    }

}
