<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionAnswer extends Model
{
//    use SoftDeletes;
    protected $table = 'question_answers';
    protected $guarded = [];
    public function question(){
        return $this->hasOne('App\Models\Question');
    }
    public function result(){
        return $this->belongsTo('App\Models\ExamResult');
    }
}
