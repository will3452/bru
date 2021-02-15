<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cpy extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function cpiable(){
        return $this->morphTo()->withTimestamps();
    }
}
