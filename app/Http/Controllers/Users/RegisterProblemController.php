<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UploadAttachment;
use App\Models\User;
use App\Http\Traits\dropDownListTraits;
use App\Http\Requests\Problems\StoreProblemsRequest;
use App\Http\Requests\Problems\UpdateProblemsRequest;
use App\Http\Traits\uplaodTrait;
use App\Models\RegisterProblem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RegisterProblemController extends Controller
{
    use dropDownListTraits ;
    use uplaodTrait;
    public function ProblemMyOrder($userId){

      $MyOrder = User::with('Problems' ,'Problems.city','Problems.SideDefect','Problems.SauseOfDefect' ,'Problems.attachments','Problems.starRating')->findorFail($userId);
    // dd($MyOrder);
      return view('users.RegisterProblem.myOrder',compact('MyOrder'));
    }

    public function ProblemCreate(){
        $SideList =  $this->sideDefectsList()->toArray();
     

        $SauseList = $this->sauseOfDefectsList()->toArray() ;

        $CitieList = $this->CitiesList()->toArray() ;


       
        return View('users.RegisterProblem.create',compact('CitieList','SauseList','SideList'));
     } // end function ProblemCreate

     public function ProblemStore(StoreProblemsRequest $request){
    

      $request->validate([
           'problem_name' => 'required|string|min:5|max:150' ,
            'tool_defect' => 'nullable|string|min:5|max:150',
            'who_cause_of_defect' => 'nullable|string|min:5|max:150',
            'city_id' => 'required',
            'side_defect_id' => 'required',
            'cause_of_defect_id' => 'required',
            'problem_details' => 'required',
            'files.*' => 'required|mimes:mp4,3gp,mov,avi,wmv,jpg,jpeg,png,pdf',
     ]);
   
     $key_problem = uniqid() ;
     $attachment = array();
     $google_file = null ;
     foreach($request->file('files') as $file)
     {
        $folder  =  substr($file->getMimeType() ,0 , strpos($file->getMimeType(),'/'));

        if($folder === 'application')
        {
          
                     $trim =  Storage::disk('google')
                                           ->putFile('1WF5EMQ_6YcTYeJoKanK1dDoY9AC-D93d',$file);

                      $google_name =  substr($trim  ,strpos($trim ,'/') +1 ,strlen($trim));
                      $allFile =   Storage::disk('google')->files();

                  
             for($i = 0 ; $i < count($allFile) ; $i++)
             {

                     $localName = Storage::disk('google')->getMetadata($allFile[$i]);

                  if($localName['name'] == $google_name )
                  {

                    $google_file=  $localName['path'] ;
                       break ;
                  }
          

              }
   
        }

          $filename = time() . uniqid() .'.' . $file->getClientOriginalExtension();
          $path = public_path('Users/Picture/problems/'.$folder .'/');
          $this->uploadImage($file, $filename  ,$path);
        
        
        
     
    
       array_push( $attachment  ,
         ['attachment_Url' => $folder .'/'. $filename ,
           'key_problem' => $key_problem  ,
           'file_name' => $file->getClientOriginalName() ,
           'google_file' =>  $google_file  ]   );
     }

     


     $newProblem =  RegisterProblem::create([
      'problem_name' =>  $request->problem_name ,
      'tool_defect' => isset( $request->tool_defect) ? $request->tool_defect  : null , 
      
      'who_cause_of_defect' =>  isset( $request->who_cause_of_defect)? $request->who_cause_of_defect : null,
      'user_id' =>  Auth::user()->id ,
      'city_id' => $request->city_id ,
      'side_defect_id' => $request->side_defect_id ,
      'cause_of_defect_id' => $request->cause_of_defect_id ,
      'problem_details' =>  $request->problem_details,
      'key_problem' => $key_problem,
     

     ]);

     

     $role_admin = \App\Models\User::where('status_roles' ,'admin')->get();

      \Illuminate\Support\Facades\Notification::send($role_admin, new \App\Notifications\NewProblemUserToAdminNotify($newProblem->load('user')));

     

  
   

   $chek =   $newProblem->attachments()->createMany($attachment);

       
   return redirect()->route('user.problems.detail',['problemId' => $newProblem->id ]);


   } // end function ProblemStore

     
public function problemDetails($problemId){

   $detail = RegisterProblem::with('attachments' ,'city','SideDefect','SauseOfDefect' ,'ProblemCommnets.ReplyCommnets' ,'ProblemCommnets.user' ,'StarRating' )->findorFail($problemId);

  //dd($detail->user);
return View('users.RegisterProblem.detailProplem',compact('detail'));


} // end  problemDetails

public function problemEdit($problemId){


   $SideList =  $this->sideDefectsList()->toArray();
     
   $SauseList = $this->sauseOfDefectsList()->toArray() ;

   $CitieList = $this->CitiesList()->toArray() ;

   $problemEdit = RegisterProblem::with('attachments' ,'city','SideDefect','SauseOfDefect')->findorFail($problemId);

  return View('users.RegisterProblem.edit',compact('problemEdit' , 'SideList','SauseList','CitieList'));

} // end function problemEdit


    public function problemUpdate(UpdateProblemsRequest $request  , $problemId)
    { 
     
     // dd($request ->validated());

      $problemUpdate = RegisterProblem::with('attachments')->findorFail($problemId);

if(!is_null($problemUpdate)){

      $attachment = $problemUpdate->attachments()->where('key_problem','=',$problemUpdate->key_problem)->where('register_problem_id','=',$problemUpdate->id);
      
      //edit attachment
      if(!is_null($request->file('fileCheck'))){

         if(is_null($request->check)){

            return redirect()-> back()->with('problem' ,'من فضل قم باختيار الملف الذي تريد استبداله وبعد كده اسحب الملف من الجهاز' );
         }

       $attachment =   $attachment->findorFail($request->check) ;
//dd($attachment ) ;
      $file = $request->file('fileCheck') ;

      $folder  =  substr($file->getMimeType() ,0 , strpos($file->getMimeType(),'/'));
      $google_file = null ;

      if($folder === 'application')
      {

                Storage::disk('google')->delete($attachment->google_file); 
   
                $trim =  Storage::disk('google')->putFile('1WF5EMQ_6YcTYeJoKanK1dDoY9AC-D93d',$file);

                $google_name =  substr($trim  ,strpos($trim ,'/') +1 ,strlen($trim));

                $allFile =   Storage::disk('google')->files();

               for($i = 0 ; $i < count($allFile) ; $i++)
               {

                       $localName = Storage::disk('google')->getMetadata($allFile[$i]);

                         if($localName['name'] == $google_name )
                         {

                             $google_file =  $localName['path'] ;
                             break ;
                           }
                }

}
      $filename = time() . uniqid() .'.' . $file->getClientOriginalExtension();
      $path = public_path('Users/Picture/problems/'.$folder .'/');
      $trimAttachment_Url = substr($attachment->attachment_Url,strpos($attachment->attachment_Url,'/')+1, \Illuminate\Support\Str::length($attachment->attachment_Url) );
     
      $oldPath = $path .   $trimAttachment_Url;
      $this->uploadImage($file, $filename  ,$path , $oldPath );
      
      $attachment->attachment_Url =  $folder .'/' . $filename ;
      $attachment->file_name =  $request->file('fileCheck')->getClientOriginalName(); 
      $attachment->google_file = $google_file ;
      $attachment->save();
   
      }

     
          //Add new  attachment
      if(!is_null( $request->file('files') ) )
      {
            $attachmentArray = array();
          foreach($request->file('files') as $file)
          {
                    $folder  =  substr($file->getMimeType() ,0 , strpos($file->getMimeType(),'/'));
                    if($folder === 'application')
                    {
                      
                                 $trim =  Storage::disk('google')
                                                       ->putFile('1WF5EMQ_6YcTYeJoKanK1dDoY9AC-D93d',$file);
            
                                  $google_name =  substr($trim  ,strpos($trim ,'/') +1 ,strlen($trim));
                                  $allFile =   Storage::disk('google')->files();
            
                              
                         for($i = 0 ; $i < count($allFile) ; $i++)
                         {
            
                                 $localName = Storage::disk('google')->getMetadata($allFile[$i]);
            
                              if($localName['name'] == $google_name )
                              {
            
                                $google_file=  $localName['path'] ;
                                   break ;
                              }
                      
            
                          }
               
                    }
                    $filename = time() . uniqid() .'.' . $file->getClientOriginalExtension();
                    $path = public_path('Users/Picture/problems/'.$folder .'/');
                    $this->uploadImage($file, $filename  ,$path);
      
     
                 array_push( $attachmentArray  , 
                                               ['attachment_Url' => $folder .'/'. $filename , 
                                               'key_problem' => $problemUpdate-> key_problem  ,
                                               'file_name' => $file->getClientOriginalName()  ,
                                               'google_file' =>  $google_file]);

           } //end foreach

           $problemUpdate->attachments()->createMany($attachmentArray);

     }//end if

   $resut =  $problemUpdate->update($request ->validated())  ;

  if($resut)
     return redirect()-> back()->with('commpleted' ,'تم تحديث البيانات بنجاح' );
     else
     return redirect()-> back()->with('problem' ,'اعد المحاوله وان ضلت المشكله قائمه رجاءا اتصل بالدعم الفني CODE:DB' );

   }
   return redirect()-> back()->with('problem' ,'اعد المحاوله وان ضلت المشكله قائمه رجاءا اتصل بالدعم الفني CODE:find' );

    } // end function problemUpdate



    public function problemDelete($attachmentID , $keyId)
    {
       $attachment = UploadAttachment::where('key_problem' ,'=' , $keyId);
       if(  count($attachment->get())  == 1 ){
         return redirect()-> back()->with('problem' ,'لا يمكن حذف هذا الملف يجب ان يكون لديك ملف واحد علي الاقل  للخل, يمكنك التعديل علي هذا الملف فقط ' );
       }
    $delete =    $attachment->findorFail($attachmentID ) ;
    Storage::disk('google')->delete($delete->google_file); 

    $delete =   $delete->delete();
    if($delete)
    return redirect()-> back()->with('commpleted' ,'تم حذف المرفق بنجاح' );
    else
    return redirect()-> back()->with('problem' ,'اعد المحاوله وان ضلت المشكله قائمه رجاءا اتصل بالدعم الفني CODE:find' );


    }// end function problemDelete

}
