<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Renewal extends Model
{
    protected $table = "renewal";
    protected $fillable = [
        'period','start_date','end_date','contract_id','notes'
    ];
    public function contract(){
        return $this->belongsTo('\App\Models\Contract','contract_id','id');
    }
}
