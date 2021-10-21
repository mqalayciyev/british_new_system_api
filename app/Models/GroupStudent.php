<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupStudent extends Model
{
//    use SoftDeletes;
    protected $table = 'group_students';
    protected $guarded = [];

    public function company(){
        return $this->belongsTo('App\Models\Company');
    }
    public function group(){
        return $this->hasOne('App\Models\GroupLesson');
    }
    public function student(){
        return $this->hasOne('App\Models\Student');
    }
}
