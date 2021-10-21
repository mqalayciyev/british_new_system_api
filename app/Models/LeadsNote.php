<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeadsNote extends Model
{
    use SoftDeletes;
    protected $table = 'leads_notes';
    protected $guarded = [];
    public function leads(){
        return $this->hasOne('App\Models\Leads');
    }
}
