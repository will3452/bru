<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    //route key binding modification
    public function getRouteKeyName()
    {
        return 'slug';
    }

    //attributes
    public function getIspublicAttribute(){
        return $this->publish_date == null ? false: true;
    }

    public function getLastchapterAttribute(){
        $chapter =  $this->chapters()->latest()->take(1)->get();
        return $chapter[0]->sq ?? 0;
    }

    //relations
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function cpy(){
        return $this->morphOne(Cpy::class, 'cpiable');
    }

    public function tags(){
        return $this->morphToMany(Tag::class, 'taggable');
    }
    
    public function books(){
        return $this->hasMany(self::class, 'series_id');
    }

    public function series(){
        return $this->belongsTo(self::class, 'series_id');
    }

    public function chapters(){
        return $this->hasMany(Chapter::class);
    }

    public function event(){
        return $this->belongsTo(Event::class);
    }

    public function  recommendation(){
        return $this->morphOne(Recommendation::class, 'recommendationable');
    }
}
