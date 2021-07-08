<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function owner(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function books(){
        return $this->morphedByMany(Book::class, 'boxable');
    }

    public function arts(){
        return $this->morphedByMany(Art::class, 'boxable');
    }

    public function audios(){
        return $this->morphedByMany(Audio::class, 'boxable');
    }

    public function podcasts(){
        return $this->morphedByMany(Podcast::class, 'boxable');
    }

    public function songs(){
        return $this->morphedByMany(Song::class, 'boxable');
    }

    public function films(){
        return $this->morphedByMany(Thrailer::class, 'boxable');
    }
}
