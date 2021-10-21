<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgeCategory extends Model
{
    use SoftDeletes;
    protected $table = 'age_categories';
    protected $guarded = [];

    public function company(){
        return $this->belongsTo('App\Models\Company');
    }
    public function test(){
        return $this->belongsTo('App\Models\Test');
    }
}
