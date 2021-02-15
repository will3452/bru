<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function setDayAway($day){
        $this->event_day_away = $day;
        $this->save();
    }
}
