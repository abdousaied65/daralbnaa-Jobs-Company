<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    protected $table = "nationalities";
    protected $fillable = [
        'nationality_ar',
        'nationality_en',
    ];

    public function employees(){
        return $this->hasMany('\App\Models\Employee','nationality_id','id');
    }
}
