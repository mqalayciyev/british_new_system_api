<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tests extends Model
{
    use SoftDeletes;
    protected $table = 'tests';
    protected $guarded = [];

    public function company(){
        return $this->belongsTo('App\Models\Company');
    }
    public function result(){
        return $this->belongsTo('App\Models\ExamResult');
    }
    public function question(){
        return $this->belongsTo('App\Models\Question');
    }
}
