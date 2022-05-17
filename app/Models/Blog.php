<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
        'blog_name',
        'blog_imgUrl',
        'blog_body_editor',
    ];

    public function Comments(){

        return $this->hasMany(BlogComment::class ,'blog_id','id');
    }
   
}
