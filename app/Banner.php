<?php

namespace App;

use App\Traits\Marketable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory, Marketable;
    protected $guarded = [];

    public function market()
    {
        return $this->belongsTo(Market::class, 'market_id');
    }

}
