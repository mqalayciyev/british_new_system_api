<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use SoftDeletes;
    protected $table = 'attendances';
    protected $guarded = [];
    public function map(){
        return $this->hasOne('App\Models\AttendanceMap');
    }
}
