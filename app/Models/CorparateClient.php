<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CorparateClient extends Model
{
    use SoftDeletes;
    protected $table = 'corparate_clients';
    protected $guarded = [];

    public function company(){
        return $this->belongsTo('App\Models\Company');
    }
    public function student(){
        return $this->belongsTo('App\Models\Student');
    }
}
