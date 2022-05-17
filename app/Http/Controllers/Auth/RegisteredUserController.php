<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;
use App\Models\Citie;
use App\Http\Traits\uplaodTrait;
class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    use uplaodTrait ;
   
    private function CityList(){
        $DropDwon =  Citie::pluck('City_name', 'id')->toArray();
        return $DropDwon ;
    }

    public function create()
    {

        $DropDwonCity  = $this->CityList();
        return view('auth.register',compact('DropDwonCity'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */

     

    public function store(Request $request)
    {
      
       // dd(Str::length($request->phone)) ;
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'numeric', 'min:11',  'unique:users'],
            'city_id' => ['required', 'string'],
            'avatar' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);



        $file = $request->file('avatar') ;
        $filename ='Register_' . time() . uniqid() .'.' . $file->getClientOriginalExtension();
        $path = public_path('Users/Picture/') ;
        $this->uploadImage($file, $filename ,$path);

        $request['avatar']->getClientOriginalName = $filename ;

        info('city_id: >> ' .$request->city_id);
        info('Filename: >> ' . $request['avatar']->getClientOriginalName );

        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'city_id' => $request->city_id,
            'avatar' => $request['avatar']->getClientOriginalName ,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
