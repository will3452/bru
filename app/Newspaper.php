<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newspaper extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function pages(){
        return $this->hasMany(Newspage::class, 'newspaper_id');
    }

    public function market(){
        return $this->belongsTo(Market::class, 'market_id');
    }
}
