<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeacherPayment extends Model
{
    use SoftDeletes;
    protected $table = 'teacher_payments';
    protected $guarded = [];

    public function company(){
        return $this->belongsTo('App\Models\Company');
    }
    public function teacher(){
        return $this->belongsTo('App\Models\Teacher');
    }
}
