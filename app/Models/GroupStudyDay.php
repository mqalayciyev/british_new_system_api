<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupStudyDay extends Model
{
//    use SoftDeletes;
    protected $table = 'group_study_days';
    protected $guarded = [];

//    public function company(){
//        return $this->belongsTo('App\Models\Company');
//    }
//    public function student(){
//        return $this->hasOne('App\Models\Student');
//    }
}
