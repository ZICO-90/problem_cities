<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SauseOfDefect extends Model
{
    use HasFactory;
    protected $fillable = [
        'sause_of_defect_name', 
    ];

    public function SauseOfDefects(){
        return $this->hasMany(RegisterProblem::class,'cause_of_defect_id','id');
    }
}
