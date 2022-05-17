<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\about;
class AboutsMeController extends Controller
{
 public function aboutMe(){

  $abouts =  about::where('status' , 1)->first();
 
  return view('users.abouts.about',compact('abouts'));

 }
}
