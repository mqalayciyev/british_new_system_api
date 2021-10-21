<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    use SoftDeletes, HasApiTokens, Notifiable;
    protected $table = 'users';
    protected $guarded = [];
    protected $hidden = array('password');

    public function company(){
        return $this->belongsTo('App\Models\Company');
    }
    public function office(){
        return $this->belongsTo('App\Models\Office');
    }
    public function message(){
        return $this->belongsTo('App\Models\Message');
    }
    public function announcement(){
        return $this->belongsTo('App\Models\Announcement');
    }
    public function notification(){
        return $this->belongsTo('App\Models\Notification');
    }

//    public function AauthAcessToken(){
//        return $this->hasMany('\App\OauthAccessToken');
//    }
}
