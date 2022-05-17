<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProblemCommnet extends Model
{
    use HasFactory;
    protected $fillable = [
        'commnets_body',
        'user_id', 
        'register_problem_id', 
        'parent_commnet_id', 
        
    ];

    public function user(){

        return $this->belongsTo(User::class,'user_id','id');
    }

    public function Problem(){

        return $this->belongsTo(RegisterProblem::class,'register_problem_id','id');
    }

    public function ProblemCommnet(){

        return $this->belongsTo(ProblemCommnet::class,'parent_commnet_id','id');
    }

    public function ReplyCommnets(){

        return $this->hasMany(ProblemCommnet::class,'parent_commnet_id','id');
    }
}
