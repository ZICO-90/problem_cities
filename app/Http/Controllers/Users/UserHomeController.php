<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RegisterProblem;
class UserHomeController extends Controller
{
    public function userHome(){
        $detail = RegisterProblem::with('attachments' ,'city','SideDefect','SauseOfDefect' ,'ProblemCommnets.ReplyCommnets' ,'ProblemCommnets.user' ,'StarRating' )->paginate(4);

   //dd($detail ) ;
        return View('users.index',compact('detail'));
     }
}
