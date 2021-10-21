<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeacherLevel extends Model
{
    protected $table = 'teacher_levels';
    protected $guarded = [];

    public function company(){
        return $this->belongsTo('App\Models\Company');
    }
    public function teacher(){
        return $this->hasOne('App\Models\Teacher');
    }
    public function level(){
        return $this->hasOne('App\Models\Level');
    }
}
