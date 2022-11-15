<?php

namespace App\Exports;
use App\Models\Application;
use App\Models\Dept;
use App\Models\Offer;
use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DirectWorkExport implements FromCollection,WithHeadings,WithMapping
{
    public function collection()
    {
        $applications = Application::all();

        foreach ($applications as $application){

            $application->setAttribute('phone_number', Offer::FindOrFail($application->offer_id)->phone_number);
            $application->setAttribute('project_manager',Project::FindOrFail($application->project_id)->supervisors()->latest('id')->first()->supervisor_name_ar);
        }

        $applications->transform(function($i){
            $i->offer_id = Offer::FindOrFail($i->offer_id)->employee_name;
             $i->project_id = Project::FindOrFail($i->project_id)->project_name_ar;
            $i->direct_work_status = isset($i->direct_work_status) ? ($i->direct_work_status==1 ?trans('main.directwork') :trans('main.notWork')):'';
            return $i;
        });
        return $applications ;
    }
    public function headings(): array
    {
        return [
            'الموظف',
            'رقم جوال',
            'التاريخ',
            'اسم المشروع',
            'المدير',
            'الحالة',
        ];
    }

    public function map($applications): array
    {
        return [
            $applications->offer_id,
            $applications->phone_number,
            $applications->date,
            $applications->project_id,
            $applications->project_manager,
            $applications->direct_work_status,
        ];
    }

}
