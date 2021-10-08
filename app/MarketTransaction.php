<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketTransaction extends Model
{
    protected $table = 'marketing_transactions';
    use HasFactory;
    protected $guarded = [];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function market()
    {
        return $this->belongsTo(Market::class);
    }
}
