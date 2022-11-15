<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Notifications\ResetPasswordNotification;
use App\Notifications\VerifyEmailNotification;

class Supervisor extends Authenticatable
{
    use Notifiable,HasRoles;
    protected $table = 'supervisors';
    protected $guard = 'supervisor-web';
    protected $guard_name = 'supervisor-web';
    protected $fillable = [
        'supervisor_name_ar','supervisor_name_en', 'email', 'password','role_name','Status',
        'phone_number','profile_pic','dept_id','job_title_id'
    ];

    public function projects(){
        return $this->belongsToMany('\App\Models\Project','supervisor_project','supervisor_id','project_id','id','id');
    }

    public function dept(){
        return $this->belongsTo('\App\Models\Dept','dept_id','id');
    }
    public function job_title(){
        return $this->belongsTo('\App\Models\JobTitle','job_title_id','id');
    }

    protected $hidden = [
        'password', 'remember_token',
        'email_verified_at'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token, 'supervisor.password.reset', 'supervisors'));
    }
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification('supervisor.verification.verify'));
    }
}
