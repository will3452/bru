<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Event extends Model
{
    use HasFactory;
    protected $guarded = [];

    //scopes
    public function scopePending($query)
    {
        return $query->whereNull('status');
    }

    public function scopeApproved($query)
    {
        return $query->whereNotNull('status');
    }

    //format date
    public function date_format($string)
    {
        return Carbon::parse($string)->format('m/d/Y');
    }
    //relations
    public function eventable()
    {
        return $this->morphTo();
    }

    public function book()
    {
        return $this->hasOne(Book::class, 'event_id');
    }

    public function game()
    {
        return $this->hasOne(Game::class);
    }

    public function isInPrice($str)
    {
        $prizes = explode(', ', $this->game->prizes);
        return in_array($str, $prizes);
    }

    public function winners()
    {
        return $this->hasMany(Winner::class);
    }

    public function work()
    {
        if ($this->book_id) {
            return [
                'title' => Book::find($this->book_id)->title,
                'type' => 'Book',
            ];
        } else if ($this->art_id) {
            return [
                'title' => Art::find($this->art_id)->title,
                'type' => 'Art Scene',
            ];
        } else if ($this->song_id) {
            return [
                'title' => Song::find($this->id),
                'type' => 'Song',
            ];
        } else if ($this->thrailer_id) {
            return [
                'title' => Thrailer::find($this->thrailer_id)->title,
                'type' => 'Film/Trailer/Animation',
            ];
        } else if ($this->audio_id) {
            return [
                'title' => Audio::find($this->audio_id)->title,
                'type' => 'Audio Book',
            ];
        } else if ($this->podcast_id) {
            return [
                'title' => Podcast::find($this->podcast_id),
                'type' => 'Podcast',
            ];
        }
        return null;
    }

}
