<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LearningType extends Model
{
    use SoftDeletes;
    protected $table = 'learning_types';
    protected $guarded = [];

    public function company(){
        return $this->belongsTo('App\Models\Company');
    }
    public function group(){
        return $this->belongsTo('App\Models\GroupLesson');
    }
    public function private(){
        return $this->belongsTo('App\Models\PrivateLesson');
    }
}
