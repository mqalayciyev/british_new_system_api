<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamResult extends Model
{
    use SoftDeletes;
    protected $table = 'exams_results';
    protected $guarded = [];

    public function company(){
        return $this->belongsTo('App\Models\Company');
    }
    public function exam(){
        return $this->hasOne('App\Models\Exam');
    }
    public function type(){
        return $this->hasOne('App\Models\ExamType');
    }
    public function student(){
        return $this->hasOne('App\Models\Student');
    }
    public function test(){
        return $this->hasOne('App\Models\Test');
    }
    public function question(){
        return $this->hasOne('App\Models\Question');
    }
    public function answer(){
        return $this->hasOne('App\Models\QuestionAnswer');
    }
}
