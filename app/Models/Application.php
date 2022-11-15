<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $table = "applications";
    protected $fillable = [
        'offer_id','date','application_type','dept_id','project_id','identity_number',
        'basic_salary','status','decline_reason',
        'passport_number','employee_address', 'another_phone_number','email','notes',
        'social_security','documents_complete','medical_insurance','support_registered','identity_expiration_date','direct_work_status'
    ];
    public function dept(){
        return $this->belongsTo('\App\Models\Dept','dept_id','id');
    }
    public function project(){
        return $this->belongsTo('\App\Models\Project','project_id','id');
    }
    public function offer(){
        return $this->belongsTo('\App\Models\Offer','offer_id','id');
    }
    public function job_titles(){
        return $this->hasMany('\App\Models\ApplicationReviewer','application_id','id');
    }

}
