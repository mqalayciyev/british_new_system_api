<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupLesson extends Model
{
    use SoftDeletes;
    protected $table = 'group_lessons';
    protected $guarded = [];

    public function company(){
        return $this->belongsTo('App\Models\Company');
    }
    public function office(){
        return $this->hasOne('App\Models\Office');
    }
    public function teacher(){
        return $this->hasOne('App\Models\Teacher');
    }
    public function level(){
        return $this->hasOne('App\Models\User');
    }
    public function price(){
        return $this->hasOne('App\Models\AcademicHours');
    }
    public function type(){
        return $this->hasOne('App\Models\LearningType');
    }
    public function lesson(){
        return $this->hasOne('App\Models\Lesson');
    }
    public function groupStudent(){
        return $this->belongsTo('App\Models\GroupStudent');
    }
}
