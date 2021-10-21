<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use SoftDeletes;
    protected $table = 'media';
    protected $guarded = [];

    public function company(){
        return $this->belongsTo('App\Models\Company');
    }
    public function assignee(){
        return $this->hasOne('App\Models\Assignee');
    }
}
