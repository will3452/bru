<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Song extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function tickets()
    {
        return $this->morphMany(Ticket::class, 'ticketable');
    }

    public function collections()
    {
        return $this->morphToMany(Collection::class, 'collectionable');
    }

    public function albums()
    {
        return $this->morphToMany(Album::class, 'albumable');
    }

    public function boxes(){
        return $this->morphToMany(Box::class, 'boxable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
    
    public function playlists()
    {
        return $this->morphToMany(Playlist::class, 'playlistable');
    }
}
