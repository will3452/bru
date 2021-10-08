<?php

namespace App;

use App\Traits\Invoiceable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Market extends Model
{
    use HasFactory, Invoiceable;

    protected $guarded = [];

    public function getUniqueIdAttribute()
    {
        return Str::padLeft($this->id, 7, '0');
    }

    public function getDayDurationAttribute()
    {
        return explode('-', $this->duration)[0];
    }
    public function getCostAttribute()
    {
        return explode('-', $this->duration)[1];
    }
    public function getStringCategoryAttribute()
    {
        $arr = explode('_', $this->category);
        return implode(' ', $arr);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bulletin()
    {
        return $this->hasOne(Bulletin::class, 'market_id');
    }

    public function announcement()
    {
        return $this->hasOne(Announcement::class, 'market_id');
    }

    public function banner()
    {
        return $this->hasOne(Banner::class, 'market_id');
    }

    public function message_blasts()
    {
        return $this->hasMany(MessageBlast::class, 'market_id');
    }

    public function preloader()
    {
        return $this->hasOne(Preloader::class, 'market_id');
    }

    public function newspaper()
    {
        return $this->hasOne(Newspaper::class, 'market_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function marketTransaction()
    {
        return $this->hasOne(MarketTransaction::class);
    }
}
