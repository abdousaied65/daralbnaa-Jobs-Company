<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = "projects";
    protected $fillable = [
        'project_name_ar',
        'project_name_en',
        'dept_id','added_date','project_end_date'
    ];
    public function dept(){
        return $this->belongsTo('\App\Models\Dept','dept_id','id');
    }

    public function supervisors(){
        return $this->belongsToMany('\App\Models\Supervisor','supervisor_project','project_id','supervisor_id','id','id');
    }

    public function employees(){
        return $this->hasMany('\App\Models\Employee','project_id','id');
    }
}
