<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Event extends Model
{
    use HasFactory;
    protected $guarded = [];

    //format date
    public function date_format($string)
    {
        return Carbon::parse($string)->format('m/d/Y');
    }
    //relations
    public function eventable()
    {
        return $this->morphTo();
    }

    public function book()
    {
        return $this->hasOne(Book::class, 'event_id');
    }

    public function game()
    {
        return $this->hasOne(Game::class);
    }

    public function isInPrice($str)
    {
        $prizes = explode(', ', $this->game->prizes);
        return in_array($str, $prizes);
    }

    public function winners()
    {
        return $this->hasMany(Winner::class);
    }

}
