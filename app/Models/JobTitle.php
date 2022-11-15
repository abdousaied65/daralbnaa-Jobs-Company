<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class JobTitle extends Model
{
    protected $table = "job_titles";
    protected $fillable = [
        'job_title_ar',
        'job_title_en',
        'dept_id',
        'rank'
    ];

    public function dept(){
        return $this->belongsTo('\App\Models\Dept','dept_id','id');
    }
    public function supervisors(){
        return $this->hasMany('\App\Models\Supervisor','job_title_id','id');
    }

    public function employees(){
        return $this->hasMany('\App\Models\Employee','job_title_id','id');
    }

}
