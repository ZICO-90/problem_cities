<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'attachment_Url', 
        'register_problem_id', 
        'key_problem',
        'file_name',
        'google_file'
    ];

    public function Problem(){

        return $this->belongsTo(RegisterProblem::class,'register_problem_id' ,'id');
    }
}
