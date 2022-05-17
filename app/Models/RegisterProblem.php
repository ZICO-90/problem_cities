<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterProblem extends Model
{
    use HasFactory;
    protected $fillable = [
        'problem_name',
        'tool_defect', 
        'problem_details', 
        'who_cause_of_defect', 
        'user_id', 
        'city_id', 
        'side_defect_id', 
        'cause_of_defect_id', 
        'tap_order_status',
        'problem_current_status',
        'key_problem',
       
    ];

    protected $appends = ['order_status'];

    public function attachments(){
        return $this->hasMany(UploadAttachment::class,'register_problem_id','id');
    }

    public function ProblemCommnets(){

        return $this->hasMany(ProblemCommnet::class,'register_problem_id' ,'id')->whereNull('parent_commnet_id');
    }

    public function city(){

        return $this->belongsTo(Citie::class,'city_id','id');
    }

    public function SideDefect(){

        return $this->belongsTo(SideDefect::class,'side_defect_id');
    }

    public function SauseOfDefect(){

        return $this->belongsTo(SauseOfDefect::class,'cause_of_defect_id','id');
    }
    public function user(){

        return $this->belongsTo(User::class,'user_id');
    }

    

   

  

    public function StarRating(){
        return $this->hasOne(StarRating::class,'register_problem_id','id');
    }

  


    public function getOrderStatusAttribute(){

        $arr = [
            '1' => 'جديد',
            '2' => 'قيد المراجعه',
            '3' => 'تمت المعيانه',
            '4' => 'تم الاغلاق',

        ];
            if($this->tap_order_status != null){
                return $arr[$this->tap_order_status];
            }else{

                return 'جديد';
            }

    } // end  function getTapOrderStatusAttribute

    




} //end  class RegisterProblem
