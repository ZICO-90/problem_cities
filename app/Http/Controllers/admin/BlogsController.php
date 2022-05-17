<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Blogs\BlogsStoreRequest;
use App\Http\Requests\Blogs\BlogsUpdateeRequest;
use App\Models\Blog;
use App\Http\Traits\uplaodTrait;
use Illuminate\Support\Arr ;
class BlogsController extends Controller
{
    use uplaodTrait ;
   
    public function blogIndex(){
        $blogsList = Blog::paginate(4);
      
        return View('dashboard.blogs.index' , compact('blogsList'));
     }


     public function blogsCreate(){
   
        return View('dashboard.blogs.create');
     }

     public function blogsStore(BlogsStoreRequest $request){

        $request->validate([
            'blog_name' => 'required|string|min:5|max:150' ,
            'File_imgUrl' => 'required',
            'blog_body_editor' => 'required',
        ]);
      
        $file = $request->file('File_imgUrl') ;
        $filename ='Blogs_' . time() . uniqid() .'.' . $file->getClientOriginalExtension();
        $path = public_path('admindashboard/picture/blogs/') ;
        $this->uploadImage($file, $filename ,$path);
      
      $check =  Blog::create([
          'blog_name' => $request->blog_name ,
          'blog_imgUrl' =>  $filename  ,
          'blog_body_editor' => $request->blog_body_editor ]);
   
          info('blogs insert >>>>> ' .$check );
        if(!is_null($check))
        return redirect()-> back()->with('commpleted' , 'تم اضافة المنشور بنجاح');
        else
        return redirect()-> back()->with('problem','اعد المحاوله واذا كانت المشكلة قائمه اتصل بالدعم الفني');
     }


     public function blogsEdit($blogId){

        $blogeEdit =   Blog::findorFail($blogId);
        return View('dashboard.blogs.edit',compact('blogeEdit'));
     }

     public function blogsUpdate(BlogsUpdateeRequest $request ,$blogId)
     {
        $blogeEdit =   Blog::findorFail($blogId); 
        
        $request->validate([
            'blog_name' => 'required|string|min:5|max:150' ,
            'File_imgUrl' => 'nullable',
            'blog_body_editor' => 'required',
            
        ]);

        $file = $request->file('File_imgUrl') ;

        if(!is_null( $file )){
            $filename ='Blogs_' . time() . uniqid() .'.' . $file->getClientOriginalExtension();
            $path = public_path('admindashboard/picture/blogs/') ;
            $oldPath = $path . $blogeEdit->blog_imgUrl ;
          $this->uploadImage($file, $filename ,$path,$oldPath);

         $blogeEdit->blog_imgUrl  = $filename ;

        }
       
       $check =    $blogeEdit->update($request->validated());
       
       if( $check == 1 ? (bool)$check  : (bool)$check )
       return redirect()-> back()->with('commpleted' , 'تم تعديل المنشور بنجاح');
       else
       return redirect()-> back()->with('problem','اعد المحاوله واذا كانت المشكلة قائمه اتصل بالدعم الفني');

     }

     public function blogSingle($blogId ,$returnUrl = null) {

        $blogsSingle= Blog::with('Comments','Comments.user')->findorFail($blogId);
        if(empty($returnUrl )){
         $blogsSingle->count_views++;
         $blogsSingle->save();
        }
      
       
        return View('dashboard.blogs.blogSingle' , compact('blogsSingle'));


     }

     public function blogDelete($blogId) {

      $blogsDelete= Blog::findorFail($blogId);

      $path = public_path('admindashboard/picture/blogs/') ;
      $path = $path . $blogsDelete->blog_imgUrl ;
       \Illuminate\Support\Facades\File::delete($path);
       
      $checkItem = $blogsDelete->delete();
      if($checkItem)
      return redirect()-> back()->with('commpleted' , 'تم حذف المنشور بنجاح');
      else
      return redirect()-> back()->with('problem','اعد المحاوله واذا كانت المشكلة قائمه اتصل بالدعم الفني');



   }

}
