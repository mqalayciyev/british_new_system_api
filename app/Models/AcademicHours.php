<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcademicHours extends Model
{
    use SoftDeletes;
    protected $table = 'academic_hours';
    protected $guarded = [];

    public function company(){
        return $this->belongsTo('App\Models\Company');
    }
    public function group(){
        return $this->belongsTo('App\Models\GroupLesson');
    }
}
