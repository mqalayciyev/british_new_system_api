<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentLesson extends Model
{
//    use SoftDeletes;
    protected $table = 'student_lessons';
    protected $guarded = [];

    public function company(){
        return $this->belongsTo('App\Models\Company');
    }
    public function student(){
        return $this->hasOne('App\Models\Student');
    }
    public function lesson(){
        return $this->hasOne('App\Models\Lesson');
    }
}
