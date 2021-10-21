<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Office extends Model
{
    use SoftDeletes;
    protected $table = 'offices';
    protected $guarded = [];

    public function company(){
        return $this->belongsTo('App\Models\Company');
    }
    public function group(){
        return $this->belongsTo('App\Models\GroupLesson');
    }
    public function demo(){
        return $this->belongsTo('App\Models\DemoLesson');
    }
    public function private(){
        return $this->belongsTo('App\Models\PrivateLessson');
    }
    public function exam(){
        return $this->belongsTo('App\Models\Exam');
    }
    public function attendance(){
        return $this->belongsTo('App\Models\AttendanceMap');
    }
    public function payment(){
        return $this->belongsTo('App\Models\Payment');
    }
    public function user(){
        return $this->hasMany('App\Models\User');
    }
}
