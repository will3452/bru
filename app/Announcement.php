<?php

namespace App;

use App\Traits\Marketable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory, Marketable;
//this is marquee
    protected $guarded = [];

    public function market()
    {
        return $this->belongsTo(Market::class);
    }
}
