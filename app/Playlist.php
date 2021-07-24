<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function songs(){
        return $this->morphedByMany(Song::class, 'playlistable');
    }

    public function audios(){
        return $this->morphedByMany(Audio::class, 'playlistable');
    }

    public function podcasts(){
        return $this->morphedByMany(Podcast::class, 'playlistable');
    }
}
