<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RegisterProblem;
use Illuminate\Support\Facades\Notification;
use App\Events\StatusProblemEvents;
class SettingProblemController extends Controller
{
    public function problemIndex(){

        $problem =  RegisterProblem::with('attachments','city','SideDefect','SauseOfDefect','user')->get();
        // dd($problem);
        return  view('dashboard.SettingProblem.index',compact('problem'));

    }

    public function changeTagStatus(Request $request , $problemId){
       
       

     $changeStatus =    RegisterProblem::findorFail($problemId);

     $changeStatus->tap_order_status = $request->tap_order_status ;

     $changeStatus->save();

     $user_Send =  \App\Models\User::findorFail($changeStatus->user_id);
   
 Notification::send($user_Send, new \App\Notifications\StatusProblemNotify($changeStatus));
 $notifyCountUser = $user_Send->unreadnotifications;
//broadcast(new StatusProblemEvents($changeStatus , count($status->toArray())  ));
//broadcast(new StatusProblemEvents($changeStatus ));
event(new StatusProblemEvents($changeStatus ,count($notifyCountUser->toArray())));
     return redirect()->back();


    }
}
