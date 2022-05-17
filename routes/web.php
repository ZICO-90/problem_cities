<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminHomeController;

use App\Http\Controllers\admin\BlogsController;
use App\Http\Controllers\admin\BlogCommnetsController;
use App\Http\Controllers\admin\AboutController;
use App\Http\Controllers\admin\SettingProblemController;

use App\Http\Controllers\Users\RegisterProblemController;
use App\Http\Controllers\Users\ProblemCommentsController;
use App\Http\Controllers\Users\UserHomeController;


use App\Http\Controllers\Users\BlogsUserController;
use App\Http\Controllers\Users\BlogUserCommnetsController;
use App\Http\Controllers\Users\StarRatingController;

use App\Http\Controllers\Users\AboutsMeController;

use App\Http\Controllers\Users\chatController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'admin' , 'as' => 'admin.'],function(){

    Route::get('/',[AdminHomeController::class,'adminHome'])->name('index');

    Route::group(['prefix' => 'blogs' , 'as' => 'blogs.'],function(){
     
        Route::get('/',[BlogsController::class,'blogIndex'])->name('index');

        Route::get('/create',[BlogsController::class,'blogsCreate'])->name('create');
        Route::post('/store' , [BlogsController::class,'blogsStore'])->name('store');
        Route::get('/edit/{blogId}' , [BlogsController::class,'blogsEdit'])->name('edit');
        Route::patch('/update/{blogId}' , [BlogsController::class,'blogsUpdate'])->name('update');
        Route::get('/blog-single/{blogId}/{returnUrl?}' , [BlogsController::class,'blogSingle'])->name('blogSingle')->where(['blogId'=> '[0-9]+']);
        Route::get('/blog-delete/{blogId}' , [BlogsController::class,'blogDelete'])->name('blogDelete')->where(['blogId'=> '[0-9]+']);



    }); // end Route Group blogs



    Route::group(['prefix' => 'commnets' , 'as' => 'comments.'],function(){

        Route::POST('/store/{blogID}',[BlogCommnetsController::class,'newComments'])->name('store')->where(['blogID'=> '[0-9]+']);
        Route::PUT('/edit/{commentId}/{blogid}',[BlogCommnetsController::class,'CommentsUpdate'])->name('edit')->where(['commentId'=> '[0-9]+' , 'blogid' => '[0-9]+']);
        Route::delete('/delete/{deleteId}',[BlogCommnetsController::class,'CommentsDelete'])->name('delete')->where(['deleteId'=> '[0-9]+']);

    }); // end Route Group commnets


    Route::group(['prefix' => 'setting-problem' , 'as' => 'setting.problem.'],function(){

        Route::get('/',[SettingProblemController::class,'problemIndex'])->name('index');
        Route::PUT('/change-status/{problemId}',[SettingProblemController::class,'changeTagStatus'])->name('status');




    }); // end Route Group setting-problem


    Route::group(['prefix' => 'abouts' , 'as' => 'abouts.'],function(){

        Route::get('/',[AboutController::class,'aboutIndex'])->name('index');
        Route::get('/edit/{id}',[AboutController::class,'aboutEdit'])->name('edit');
        Route::get('/create',[AboutController::class,'aboutCreate'])->name('create');
        Route::post('/store',[AboutController::class,'aboutStore'])->name('store');
        Route::get('/delete/{del}',[AboutController::class,'aboutDelete'])->name('delete');
        Route::get('/active/{id}/{bool}',[AboutController::class,'IsDisplayActive'])->name('active');
        
        Route::put('/update/{id}',[AboutController::class,'aboutUpdate'])->name('update');





    }); // end Route Group abouts


});// end Route Group admin


Route::group(['prefix' => 'user' , 'as' => 'user.'],function(){

    Route::get('/',[UserHomeController::class,'userHome'])->name('index');


    Route::group(['prefix' => 'problems' , 'as' => 'problems.'],function(){

        Route::get('/my-order/{userId}',[RegisterProblemController::class,'ProblemMyOrder'])->name('myorder');
        Route::get('/create',[RegisterProblemController::class,'ProblemCreate'])->name('create');

        Route::post('/store',[RegisterProblemController::class,'ProblemStore'])->name('store');
        Route::get('/detail/{problemId}',[RegisterProblemController::class,'problemDetails'])->name('detail');
        Route::get('/edit/{problemId}',[RegisterProblemController::class,'problemEdit'])->name('edit');
        Route::PUT('/update/{problemId}',[RegisterProblemController::class,'problemUpdate'])->name('update');

        Route::get('/attachment-delete/{attachmentID}/{keyId}',[RegisterProblemController::class,'problemDelete'])->name('attachment.delete');



    }); // end Route Group problems

    Route::group(['prefix' => 'problem-comment' , 'as' => 'problem.comment.'],function(){

        Route::POST('/add-comment/{problemId}',[ProblemCommentsController::class,'CommentMaster'])->name('master');
        Route::PUT('/edit/{commentId}',[ProblemCommentsController::class,'CommentEdit'])->name('edit');
        Route::get('/delete-reply/{commentId}',[ProblemCommentsController::class,'deleteReply'])->name('delete.reply');
        Route::get('/delete-master/{commentId}',[ProblemCommentsController::class,'deleteMaster'])->name('delete.master');
        Route::POST('/add-reply/{problemId}/{commentId}',[ProblemCommentsController::class,'CommentReply'])->name('reply');
        


    }); // end Route Group problem-comment

    Route::group(['prefix' => 'blog-user' , 'as' => 'blog.user.'],function(){

        Route::get('/',[BlogsUserController::class,'blogIndex'])->name('index');
        Route::get('/blog-single/{blogId}/{returnUrl?}' , [BlogsUserController::class,'blogSingle'])->name('blogSingle')->where(['blogId'=> '[0-9]+']);


    }); // end Route Group blog-user


    Route::group(['prefix' => 'blog-user-comments' , 'as' => 'blog.user.comments.'],function(){

       
        Route::POST('/store/{blogID}',[BlogUserCommnetsController::class,'newComments'])->name('store')->where(['blogID'=> '[0-9]+']);
        Route::PUT('/edit/{commentId}/{blogid}',[BlogUserCommnetsController::class,'CommentsUpdate'])->name('edit')->where(['commentId'=> '[0-9]+' , 'blogid' => '[0-9]+']);
        Route::delete('/delete/{deleteId}',[BlogUserCommnetsController::class,'CommentsDelete'])->name('delete')->where(['deleteId'=> '[0-9]+']);

    }); // end blog-user-comments


    Route::group(['prefix' => 'star-rating' , 'as' => 'star.rating.'],function(){

       
        Route::POST('/store/{problemId}',[StarRatingController::class,'StarRatingStore'])->name('store')->where(['problemId'=> '[0-9]+']);
      

    });


    Route::group(['prefix' => 'about-me' , 'as' => 'about.me.'],function(){

       
        Route::get('/',[AboutsMeController::class,'aboutMe'])->name('abouts');
      

    }); // end Route Group about-me


    Route::group(['prefix' => 'user-chat' , 'as' => 'chat.'],function(){

       
        Route::get('/',[chatController::class,'chat'])->name('index');
        Route::post('/message',[chatController::class,'send'])->name('message');
      

    });



 

}); // end Route Group user



Route::get('tt', function() {
    
    $files = Storage::disk('google')->getMetadata('1aYpVs0l1lmmRUOExgk81LOeIjpDHZ5TOu0k15OT');
    dd($files );
    // $name = $files[0] ;
   // $filesname = Storage::disk('google')->getMetadata($name);
   
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
