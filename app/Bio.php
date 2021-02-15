<?php

namespace App;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bio extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getBdayAttribute(){
        return Carbon::parse($this->birthdate);
    }

    public function getAgeAttribute(){
        return Carbon::parse($this->birthdate)->age;
    }
    //relations

    public function user(){
        return $this->belongsTo(User::class);
    }
}
