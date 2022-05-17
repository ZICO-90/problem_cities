<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StarRating extends Model
{
    use HasFactory;
    protected $fillable = [
        'rating', 
        'star', 
        'comment', 
        'register_problem_id', 
    ];
    protected $appends = ['raing_string'];

    public function RatingProblem(){

        return $this->belongsTo(RegisterProblem::class,'register_problem_id','id');
    }

    public function getRaingStringAttribute(){

        return $string = ($this->rating * 100) . '%' ;



    } // end  function getTapOrderStatusAttribute
   
}
