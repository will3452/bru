<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function dateFormat($string){
        return Carbon::parse($string)->format('m/d/Y');
    }

    public function daysDurationCount($from = null){
        if(!isset($from)){
            $from = Carbon::parse($this->from_date);
        }
        $to = Carbon::parse($this->to_date);
        return $to->diffInDays($from);
    }
}

