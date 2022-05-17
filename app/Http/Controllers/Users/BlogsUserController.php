<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Route;
class BlogsUserController extends Controller
{
    
   
    public function blogIndex(){
        $blogsList = Blog::paginate(4);
       
        return View('users.ShowBlogs.BlogsUser' , compact('blogsList'));
     }

     public function blogSingle($blogId, $returnUrl =null) {
    
        $blogsSingle= Blog::with('Comments','Comments.user')->findorFail($blogId);
        if(empty($returnUrl)){
            $blogsSingle->count_views++;
            $blogsSingle->save();
        }
    
     
        return View('users.ShowBlogs.blogSingleUser' , compact('blogsSingle'));


     }


}
