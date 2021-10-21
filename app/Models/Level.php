<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Level extends Model
{
    use SoftDeletes;
    protected $table = 'levels';
    protected $guarded = [];

    public function company(){
        return $this->belongsTo('App\Models\Company');
    }
    public function group(){
        return $this->belongsTo('App\Models\GroupLesson');
    }
    public function exam(){
        return $this->belongsTo('App\Models\Exam');
    }
    public function test(){
        return $this->belongsTo('App\Models\Test');
    }
    public function lesson(){
        return $this->belongsTo('App\Models\Lesson');
    }
    public function teacher(){
        return $this->belongsTo('App\Models\TeacherLevel');
    }
}
