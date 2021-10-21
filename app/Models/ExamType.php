<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamType extends Model
{
    use SoftDeletes;
    protected $table = 'exam_types';
    protected $guarded = [];

    public function company(){
        return $this->belongsTo('App\Models\Company');
    }
    public function exam(){
        return $this->belongsTo('App\Models\Exam');
    }
    public function result(){
        return $this->belongsTo('App\Models\ExamResult');
    }
}
