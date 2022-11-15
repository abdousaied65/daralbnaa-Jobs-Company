<?php

namespace App\Exports;
use App\Models\Application;
use App\Models\Dept;
use App\Models\Offer;
use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ApplicationsExport implements FromCollection,WithHeadings
{
    public function collection()
    {
        $applications = Application::select('offer_id','date','application_type','dept_id',
            'passport_number','employee_address', 'another_phone_number','email','notes',
            'identity_number','identity_expiration_date','basic_salary','social_security',
            'documents_complete','medical_insurance','support_registered','status','created_at')->get();
        $applications->transform(function($i){
            $i->offer_id = Offer::FindOrFail($i->offer_id)->employee_name;
            $i->dept_id = Dept::FindOrFail($i->dept_id)->dept_name_ar;
            $i->application_type = trans('main.'.$i->application_type.'');
            $i->social_security = trans('main.'.$i->social_security.'');
            $i->documents_complete = trans('main.'.$i->documents_complete.'');
            $i->medical_insurance = trans('main.'.$i->medical_insurance.'');
            $i->support_registered = trans('main.'.$i->support_registered.'');
            $i->status = trans('main.'.$i->status.'');

            return $i;
        });
        return $applications;
    }
    public function headings(): array
    {
        return [
            'الموظف',
            'التاريخ',
            'نوع الطلب',
            'الادارة',
            'رقم جواز السفر','عنوان الموظف','رقم جوال اخر','البريد الالكترونى','ملاحظات',
            'رقم الهوية - الاقامة',
            'تاريخ انتهاء الهوية',
            'اساسى الراتب',
            'بدل سكن',
            'بدل نقل',
            'التسجيل فى التأمينات الاجتماعية',
            'المستندات كاملة',
            'التأمين الطبي',
            'تسجيل الدعم',
            'الحالة',
            'تاريخ الاضافة',
        ];
    }

}
