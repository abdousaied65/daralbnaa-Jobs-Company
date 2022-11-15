<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $table = "contracts";
    protected $fillable = [
        'application_id','date','employee_id',
        'employee_name','nationality_id','identity_number','passport_number','employee_address',
        'phone_number','another_phone_number','email','job_title_id','contract_period',
        'start_date','end_date','basic_salary',
        'housing_allowance','transport_allowance',
        'another_allowance','total_salary', 'employee_signature','status','notes'
    ];

    public function employee(){
        return $this->belongsTo('\App\Models\Employee','employee_id','id');
    }
    public function application(){
        return $this->belongsTo('\App\Models\Application','application_id','id');
    }
    public function nationality(){
        return $this->belongsTo('\App\Models\Nationality','nationality_id','id');
    }
    public function job_title(){
        return $this->belongsTo('\App\Models\JobTitle','job_title_id','id');
    }

}
