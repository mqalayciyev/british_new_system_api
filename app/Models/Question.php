<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;
    protected $table = 'questions';
    protected $guarded = [];
    public function test(){
        return $this->hasOne('App\Models\Test');
    }
    public function result(){
        return $this->belongsTo('App\Models\ExamResult');
    }
    public function answer(){
        return $this->belongsTo('App\Models\QuestionAnswer');
    }
}
