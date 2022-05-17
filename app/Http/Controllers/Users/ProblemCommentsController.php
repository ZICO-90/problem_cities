<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProblemCommnet;
use Illuminate\Support\Facades\Auth;

class ProblemCommentsController extends Controller
{
    public function CommentMaster(Request $request  , $problemId){

//dd($request->addcomment, $userId,$problemId);
     $comments =   ProblemCommnet::create([
                    'commnets_body'=> $request->addcomment,
                    'user_id'=>Auth::user()->id ,
                    'register_problem_id'=>$problemId,
        ]);
        $getUser = \App\Models\RegisterProblem::findorFail($problemId) ;
        $isUser = \App\Models\User::findorFail($getUser->user_id);

        \Illuminate\Support\Facades\Notification::send($isUser, new \App\Notifications\NewCommentForProblemNotify($comments ->load('Problem' ,'user')));
        return redirect()->route('user.problems.detail',['problemId' => $problemId]);


    }

 

    public function CommentReply(Request $request , $problemId,$commentId){


        ProblemCommnet::create([
            'commnets_body'=> $request->commentReply,
            'user_id'=>Auth::user()->id ,
            'register_problem_id'=>$problemId,
            'parent_commnet_id' => $commentId ,
         ]);

       return redirect()->route('user.problems.detail',['problemId' => $problemId]);

    }

    public function CommentEdit(Request $request,$commentId){

       $comments = ProblemCommnet::findorFail($commentId);
       $comments->commnets_body = $request->edit_master != null ? $request->edit_master :$request->reply_edit ;
       $comments->save();

        return redirect()->route('user.problems.detail',['problemId' =>  $comments->register_problem_id ]);
    }

    public function deleteReply($commentId)
    {
        $comments = ProblemCommnet::findorFail($commentId);
        $problem_id = $comments->register_problem_id ;
        $comments->delete();

        return redirect()->route('user.problems.detail',['problemId' =>  $problem_id ]);

    }


    public function deleteMaster($commentId)
    {
        $comments = ProblemCommnet::with('ReplyCommnets')->findorFail($commentId);
        $problem_id = $comments->register_problem_id ;
        $comments->ReplyCommnets()->delete();
        $comments->delete();
        

        return redirect()->route('user.problems.detail',['problemId' =>  $problem_id ]);

    }
    


}
