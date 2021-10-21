<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;
    protected $table = 'payments';
    protected $guarded = [];

    public function company(){
        return $this->belongsTo('App\Models\Company');
    }
    public function assignee(){
        return $this->hasOne('App\Models\Assignee');
    }
    public function student(){
        return $this->hasOne('App\Models\Student');
    }
    public function office(){
        return $this->hasOne('App\Models\Office');
    }
    public function lesson(){
        return $this->hasOne('App\Models\Lesson');
    }
}
