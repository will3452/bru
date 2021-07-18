<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Market extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getUniqueIdAttribute(){
        return Str::padLeft($this->id, 7, '0');
    }

    public function getDayDurationAttribute(){
        return explode('-',$this->duration)[0];
    }
    public function getCostAttribute(){
        return explode('-',$this->duration)[1];
    }
    public function getStringCategoryAttribute(){
        $arr = explode('_', $this->category);
        return implode(' ', $arr);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function bulletin(){
        return $this->hasOne(Bulletin::class, 'market_id');
    }

    public function announcement(){
        return $this->hasOne(Announcement::class, 'market_id');
    }

    public function banner(){
        return $this->hasOne(Banner::class, 'market_id');
    }

    public function message_blasts(){
        return $this->hasMany(MessageBlast::class, 'market_id');
    }

    public function preloader(){
        return $this->hasOne(Preloader::class, 'market_id');
    }

    public function newspaper(){
        return $this->hasOne(Newspaper::class, 'market_id');
    }
}
