<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageBlast extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function market(){
        return $this->belongsTo(Market::class, 'market_id');
    }
}
