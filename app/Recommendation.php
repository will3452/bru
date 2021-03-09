<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function getTypeAttribute(){
        $arr = explode('\\', $this->recommendationable_type);
        $endOfArr  = end($arr);
        return $endOfArr;
    }
    public function recommendationable(){
        return $this->morphTo();
    }
}

