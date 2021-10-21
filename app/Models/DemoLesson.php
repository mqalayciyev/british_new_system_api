<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DemoLesson extends Model
{
    use SoftDeletes;
    protected $table = 'demo_lessons';
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
    public function student(){
        return $this->hasOne('App\Models\Student');
    }
    public function lesson(){
        return $this->hasOne('App\Models\Lesson');
    }
}
