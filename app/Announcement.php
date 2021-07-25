<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
//this is marquee
    protected $guarded = [];
    
    public function market(){
        return $this->belongsTo(Market::class);
    }
}
