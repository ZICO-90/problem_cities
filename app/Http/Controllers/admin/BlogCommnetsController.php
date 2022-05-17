<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogComment;
use Illuminate\Support\Facades\Auth;
class BlogCommnetsController extends Controller
{
    public function newComments(Request $comment , $blogID){

      
        
        BlogComment::create([
        
                'message' => $comment['message'] ,
                'blog_id'=> $blogID ,
                'user_id' => Auth::user()->id 
            ]);
        
              return redirect()->route('admin.blogs.blogSingle',['blogId' => $blogID ,'returnUrl' => 1]);
        
        } // end  function newComments

    public function CommentsUpdate(Request $request , $commentId ,$blogid)
    {
       $Update = BlogComment::findorFail($commentId);
       $Update->message =  $request->message ;
       $Update->save();

        return redirect()->route('admin.blogs.blogSingle',['blogId' => $blogid ,'returnUrl' => 1]);

    }// end  function CommentsUpdate


    public function CommentsDelete($delete)
    {
       $Destory = BlogComment::findorFail($delete);
       $blogId = $Destory->blog_id;
       $Destory->delete();

        return redirect()->route('admin.blogs.blogSingle',['blogId' => $blogId  , 'returnUrl' => 1]);

    }// end  function CommentsDelete



} // end  class BlogCommnetsController

