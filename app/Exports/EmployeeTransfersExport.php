<?php

namespace App\Exports;
use App\Models\Dept;
use App\Models\Employee;
use App\Models\EmployeeTransfer;
use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeeTransfersExport implements FromCollection,WithHeadings
{
    public function collection()
    {
        $employees_transfers = EmployeeTransfer::select('employee_id','old_dept_id','old_project_id','new_dept_id',
            'new_project_id','date','notes','status','created_at')->get();
        $employees_transfers->transform(function($i){
            $i->employee_id = Employee::FindOrFail($i->employee_id)->name_ar;
            $i->old_dept_id = Dept::FindOrFail($i->old_dept_id)->dept_name_ar;
            $i->new_dept_id = Dept::FindOrFail($i->new_dept_id)->dept_name_ar;
            $i->old_project_id = Project::FindOrFail($i->old_project_id)->project_name_ar;
            $i->new_project_id = Project::FindOrFail($i->new_project_id)->project_name_ar;
            $i->status = trans('main.'.$i->status.'');
            return $i;
        });
        return $employees_transfers;
    }
    public function headings(): array
    {
        return [
            'الموظف',
            'الادارة السابقة',
            'المشروع السابق',
            'الادارة الجديدة',
            'المشروع الجديد',
            'التاريخ',
            'ملاحظات',
            'الحالة',
            'تاريخ الاضافة',
        ];
    }

}
