<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SideDefect extends Model
{
    use HasFactory;
    protected $fillable = [
        'side_defect_name', 
    ];


    public function SideDefects(){
        return $this->hasMany(RegisterProblem::class,'side_defect_id','id');
    }
}
