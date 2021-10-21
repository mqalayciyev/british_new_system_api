<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeacherLesson extends Model
{
    protected $table = 'teacher_lessons';
    protected $guarded = [];

    public function company(){
        return $this->belongsTo('App\Models\Company');
    }
    public function teacher(){
        return $this->hasOne('App\Models\Teacher');
    }
    public function lesson(){
        return $this->hasOne('App\Models\Lesson');
    }
}
