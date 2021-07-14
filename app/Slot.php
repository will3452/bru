<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function game(){
        return $this->belongsTo(Game::class);
    }
}
