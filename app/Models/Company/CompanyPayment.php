<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyPayment extends Model
{
    use SoftDeletes;
    protected $table = 'company_payments';
    protected $guarded = [];


    public function companies()
    {
        return $this->belongsTo('App\Models\Company', 'company');
    }
}
