<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Bio extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function changeBdayFormat()
    {
        $arr = explode('/', $this->birthdate);
        $newval = implode(' ', $arr);
        return $newval;
    }

    public function getBdayAttribute()
    {
        return Carbon::parse($this->changeBdayFormat());
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->changeBdayFormat())->age;
    }

    public function setBirthdateAttribute($value)
    {
        $arr = explode('/', $value);
        $newval = implode(' ', $arr);
        $this->attributes['birthdate'] = $newval;
    }
    //relations

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
