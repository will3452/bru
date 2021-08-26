<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function invoiceable()
    {
        return $this->morphTo();
    }

    public function setProofOfPaymentAttribute($value)
    {
        $arr_path = explode('/', $value);
        $end_path = end($arr_path);
        $this->attributes['proof_of_payment'] = '/storage/fronts/' . $end_path;
    }
}
