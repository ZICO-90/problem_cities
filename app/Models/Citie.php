<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Citie extends Model
{
   
    use HasFactory;
    protected $fillable = [
        'city_name', 
    ];


    public function Problems(){
        return $this->hasMany(RegisterProblem::class,'city_id','id');
    }

   
}
