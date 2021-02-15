<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function getRouteKey(){
        return $this->slug;
    }
    public function user(){
        return $this->belongsToMany(User::class);
    }

    public function cpy(){
        return $this->morphOne(Cpy::class, 'cpiable');
    }
}
