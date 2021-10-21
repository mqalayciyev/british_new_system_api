<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evaluation extends Model
{
    use SoftDeletes;
    protected $table = 'evaluations';
    protected $guarded = [];

    public function company(){
        return $this->belongsTo('App\Models\Company');
    }
    public function student(){
        return $this->hasOne('App\Models\Student');
    }
    public function teacher(){
        return $this->hasOne('App\Models\Teacher');
    }
}
