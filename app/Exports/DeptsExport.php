<?php

namespace App\Exports;
use App\Models\Dept;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DeptsExport implements FromCollection,WithHeadings
{
    public function collection()
    {
        return Dept::select('dept_name_ar','dept_name_en','created_at')->get();
    }
    public function headings(): array
    {
        return [
            'اسم الادارة','Department Name','تاريخ الاضافة'
        ];
    }

}
