<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class EmployeeTransfer extends Model
{
    protected $table = "employees_transfers";
    protected $fillable = [
        'employee_id','old_dept_id','old_project_id','new_dept_id','new_project_id',
        'date','notes','status',
    ];

    public function employee(){
        return $this->belongsTo('\App\Models\Employee','employee_id','id');
    }

    public function old_dept(){
        return $this->belongsTo('\App\Models\Dept','old_dept_id','id');
    }

    public function new_dept(){
        return $this->belongsTo('\App\Models\Dept','new_dept_id','id');
    }

    public function old_project(){
        return $this->belongsTo('\App\Models\Project','old_project_id','id');
    }

    public function new_project(){
        return $this->belongsTo('\App\Models\Project','new_project_id','id');
    }

}
