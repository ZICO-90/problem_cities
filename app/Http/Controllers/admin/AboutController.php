<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\about;
class AboutController extends Controller
{

    public function aboutIndex()
    {
       $about = about::all();
      
        return view('dashboard.about.index',compact('about'));

    }


    public function aboutCreate()
    {
        

        return view('dashboard.about.create');

    }

    public function aboutStore(Request $request)
    {
        $request->validate([
            'details' => 'required|string|min:5' ,
            
      ]);

      about::create($request->all());

      return redirect()->route('admin.abouts.index');

    }

    public function aboutDelete($del)
    {
        about::destroy($del) ;
        return redirect()->route('admin.abouts.index');
    }


    public function IsDisplayActive($id , $bool)
    {
        
        if($bool != 1){

            $status = about::get();

            for($i=0 ; $i < count($status) ;$i++ ){

                if($status[$i]->id == $id){

                    $status[$i]-> status = 1;
                    $status[$i]->save();
                }elseif($status[$i]->id != $id){

                    $status[$i]-> status = 0;
                    $status[$i]->save();
                }  
            }


             return redirect()->back();
        }
        

       
        return redirect()->back()->with('problem' ,'It\'s already activatedt'); 

    }




    public function aboutEdit($id)
    {
       $about =  about::findorFail($id) ;

       return view('dashboard.about.edit' ,compact('about'));

    }

    public function aboutUpdate(Request $request,$id)
    {
        $about =  about::findorFail($id) ;
        $about->details = $request->details ;
        $about->save();
        return redirect()->route('admin.abouts.index');

    }
    

}
