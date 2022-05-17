<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogComment;
use Illuminate\Support\Facades\Auth;
class BlogUserCommnetsController extends Controller
{
    public function newComments(Request $comment , $blogID){

      
        
        BlogComment::create([
        
                'message' => $comment['message'] ,
                'blog_id'=> $blogID ,
                'user_id' => Auth::user()->id 
            ]);
        
              return redirect()->route('user.blog.user.blogSingle',['blogId' => $blogID ,'returnUrl' => 1]);
        
        } // end  function newComments

    public function CommentsUpdate(Request $request , $commentId ,$blogid)
    {
       $Update = BlogComment::findorFail($commentId);
       $Update->message =  $request->message ;
       $Update->save();

        return redirect()->route('user.blog.user.blogSingle',['blogId' => $blogid ,'returnUrl' => 1]);

    }// end  function CommentsUpdate


    public function CommentsDelete($delete)
    {
       $Destory = BlogComment::findorFail($delete);
       $blogId = $Destory->blog_id;
       $Destory->delete();
      // return redirect()->back();
       return redirect()->route('user.blog.user.blogSingle',['blogId' => $blogId ,'returnUrl' => 1 ]);

    }// end  function CommentsDelete



} // end  class BlogCommnetsController

