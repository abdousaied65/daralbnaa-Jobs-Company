<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class EmployeeCert extends Model
{
    protected $table = 'employee_cert';
    protected $guard = 'supervisor-web';
    protected $guard_name = 'supervisor-web';
    protected $fillable = [
        'employee_id','cert_file'
    ];
    public function employee(){
        return $this->belongsTo('\App\Models\Employee','employee_id','id');
    }
}
