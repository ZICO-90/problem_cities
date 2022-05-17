<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guard = 'status_roles';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'avatar',
        'city_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function ProblemCommnets(){
        return $this->hasMany(ProblemCommnet::class,'user_id','id');
    }

    public function Problems(){
        return $this->hasMany(RegisterProblem::class,'user_id','id');
    }

    public function chats(){

        return $this->hasMany(Chat::class,'user_id','id');
    }

/*
    public function receivesBroadcastNotificationsOn()
    {
        return 'App.Admins.'.$this->id;
    }
*/
/*
public function receivesBroadcastNotificationsOn()
{
    return 'users.'.$this->id;
}
*/

public function receivesBroadcastNotificationsOn()
    {
        return 'App.Models.User.'.$this->id;
    }
}
