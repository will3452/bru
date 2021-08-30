<?php

namespace App;

use App\Traits\Eventable;
use App\Traits\Reportable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Multicaret\Acquaintances\Traits\CanBeSubscribed;

class Book extends Model
{
    use HasFactory;
    use SoftDeletes;
    use CanBeSubscribed;
    use Reportable;
    use Eventable;

    protected $guarded = [];

    //route key binding modification
    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }

    //attributes
    public function getIspublicAttribute()
    {
        return $this->publish_date == null ? false : true;
    }

    public function setPublishDateAttribute($value)
    {
        // [$d, $m, $y] = explode('-', $value);

        // $this->attributes['publish_date'] = $y . '-' . $m . '-' . $d;
        $this->attributes['publish_date'] = $value;

    }

    public function getLastchapterAttribute()
    {
        $chapter = $this->chapters()->where('mode', 'chapter')->latest()->take(1)->get();
        return $chapter[0]->sq ?? 0;
    }

    public function scopePublished($query)
    {
        return $query->whereNotNull('publish_date')->whereDate('publish_date', '<=', now());
    }

    //relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    //start of  DEPRECATED

    public function books()
    {
        return $this->hasMany(self::class, 'series_id');
    }

    // end of  DEPRECATED

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
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

    public function group()
    {
        return $this->belongsTo(Group::class);
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

    public function quotes()
    {
        return $this->hasMany(Quote::class, 'book_id');
    }

}
