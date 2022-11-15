<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Notifications\ResetPasswordNotification;
use App\Notifications\VerifyEmailNotification;

class Employee extends Authenticatable
{
    use Notifiable,HasRoles;
    protected $table = 'employees';
    protected $fillable = [
        'name_ar','name_en', 'email', 'password','password_clear','role_name','Status','phone_number',
        'identity_number','passport_number','job_number',
        'contract_period','dept_id','project_id','job_title_id','nationality_id',
        'total_salary','weekend_vacation','yearly_vacation','identity_file','cv_file'
    ];
    protected $hidden = [
        'password', 'remember_token','email_verified_at'
    ];
    protected $casts = [
        'email_verified_at' => 'datetime','identity_file','cv_file'
    ];
    public function dept(){
        return $this->belongsTo('\App\Models\Dept','dept_id','id');
    }
    public function nationality(){
        return $this->belongsTo('\App\Models\Nationality','nationality_id','id');
    }
    public function project(){
        return $this->belongsTo('\App\Models\Project','project_id','id');
    }
    public function job_title(){
        return $this->belongsTo('\App\Models\JobTitle','job_title_id','id');
    }
    public function contracts(){
        return $this->hasMany('\App\Models\Contract','employee_id','id');
    }

    public function certs_files(){
        return $this->hasMany('\App\Models\EmployeeCert','employee_id','id');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token, 'employee.password.reset', 'employees'));
    }
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification('employee.verification.verify'));
    }
}
