<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StarRating;
use App\Models\RegisterProblem;
class StarRatingController extends Controller
{
    
    public function StarRatingStore(Request $request,$problemId){


        if(!is_null($request->addcomment))
        {

            if(is_null($request->ratingRadio))
            {
                return redirect()-> back()->with('problem' ,'من فضل اختار النجوم من 1 الي 5' );

            }
        }

        $starArray =  array('0.2' => 1,  '0.4' => 2 ,'0.6' => 3 ,'0.8'=> 4 ,'1.0' => 5 );

        $rules = array(

              'rating' => $request ->ratingRadio , 
              'star' => $starArray[$request ->ratingRadio],
              'comment' =>  $request->addcomment   ,
            );



     if(is_null($request->addcomment )){
        unset($rules['comment']);
     }
  

   $rating =   RegisterProblem::with('StarRating')->findorFail($problemId);

 
    if(!is_null($rating->StarRating)){
        return redirect()-> back()->with('problem' ,'التقييم يكون مره واحده فقط شكرا ' );
    }

     $rating->StarRating()->create( $rules) ;
        


        return redirect()->route('user.problems.detail',['problemId' => $problemId]);


    }
}
