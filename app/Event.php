<?php

namespace App;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'date', 'hosted_by', 'type', 'cost', 'gem'];

    //format date
    public function date_format($string){
        return Carbon::parse($string)->format('m/d/Y');
    }
    //relations
    public function eventable(){
        return $this->morphTo();
    }

    public function books(){
        return $this->hasMany(Book::class);
    }


}
