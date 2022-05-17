<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\MessagesDelivered;
use App\Models\Chat;
class chatController extends Controller
{
  public function chat()
  {
    $chats = Chat::get();
    $chats->load('user');
    
   
    return view('users.chat.chat',compact('chats')) ;
  }

  public function send(Request $request)
  {
    //dd(json_encode ($request->all()));
    $messages = auth()->user()->chats()->create($request->all());


    broadcast(new MessagesDelivered($messages->load('user')))->toOthers();
    
  }
}
