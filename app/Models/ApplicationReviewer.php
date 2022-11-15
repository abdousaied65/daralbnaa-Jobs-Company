<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ApplicationReviewer extends Model
{
    protected $table = "application_reviewer";
    protected $fillable = [
        'application_id','dept_id','job_title_id','review','notes'
    ];
    public function application(){
        return $this->belongsTo('\App\Models\Application','application_id','id');
    }
    public function dept(){
        return $this->belongsTo('\App\Models\Dept','dept_id','id');
    }
    public function job_title(){
        return $this->belongsTo('\App\Models\JobTitle','job_title_id','id');
    }


}
