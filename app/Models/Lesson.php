<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use SoftDeletes;
    protected $table = 'lessons';
    protected $guarded = [];

    public function company(){
        return $this->belongsTo('App\Models\Company');
    }
    public function teacher(){
        return $this->belongsTo('App\Models\TeacherLesson');
    }
    public function student(){
        return $this->belongsTo('App\Models\StudentLesson');
    }
    public function group(){
        return $this->belongsTo('App\Models\GroupLesson');
    }
    public function demo(){
        return $this->belongsTo('App\Models\DemoLesson');
    }
    public function private(){
        return $this->belongsTo('App\Models\PrivateLesson');
    }
    public function attendance(){
        return $this->belongsTo('App\Models\AttendanceMap');
    }
    public function test(){
        return $this->belongsTo('App\Models\Test');
    }
    public function payment(){
        return $this->belongsTo('App\Models\Payment');
    }
}
