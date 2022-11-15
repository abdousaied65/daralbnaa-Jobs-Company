<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Dept extends Model
{
    protected $table = "depts";
    protected $fillable = [
        'dept_name_ar',
        'dept_name_en',
    ];

    public function projects(){
        return $this->hasMany('\App\Models\Project','dept_id','id');
    }

    public function job_titles(){
        return $this->hasMany('\App\Models\JobTitle','dept_id','id');
    }

    public function supervisors(){
        return $this->hasMany('\App\Models\Supervisor','dept_id','id');
    }

    public function employees(){
        return $this->hasMany('\App\Models\Employee','dept_id','id');
    }

}
