<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Multicaret\Acquaintances\Traits\CanBeSubscribed;

class Audio extends Model
{
    use HasFactory;
    use CanBeSubscribed;

    protected $guarded = [];
    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function recommendation()
    {
        return $this->morphOne(Recommendation::class, 'recommendationable');
    }

    //static
    public static function GETPUBLISHED()
    {
        return self::whereNotNull('publish_date')->get();
    }

    //tickets that will send to the administrator to edit the book.
    public function tickets()
    {
        return $this->morphMany(Ticket::class, 'ticketable');
    }

    public function series()
    {
        return $this->morphToMany(Series::class, 'seriesable');
    }

    public function collections()
    {
        return $this->morphToMany(Collection::class, 'collectionable');
    }

    public function boxes()
    {
        return $this->morphToMany(Box::class, 'boxable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }
    public function stars()
    {
        return $this->morphMany(Star::class, 'starable');
    }

    public function playlists()
    {
        return $this->morphToMany(Playlist::class, 'playlistable');
    }
}
