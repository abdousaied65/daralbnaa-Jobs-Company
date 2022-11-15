<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table = "offers";
    protected $fillable = [
        'employee_name','phone_number','nationality_id','basic_salary',
        'housing_allowance','transport_allowance','another_allowance','total_salary','weekend_vacation','yearly_vacation',
        'contract_period','job_title_id', 'expired_at','employee_response','decline_reason'
    ];
    public function nationality(){
        return $this->belongsTo('\App\Models\Nationality','nationality_id','id');
    }
    public function job_title(){
        return $this->belongsTo('\App\Models\JobTitle','job_title_id','id');
    }
}
