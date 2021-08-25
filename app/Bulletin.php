<?php

namespace App;

use App\Traits\Marketable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bulletin extends Model
{
    use HasFactory, Marketable;
    protected $guarded = [];

    public function market()
    {
        return $this->belongsTo(Market::class, 'market_id');
    }

    public function setImageAttribute($value)
    {
        $this->attributes['image'] = $value;
        $this->attributes['image_post'] = $value;
    }

}
