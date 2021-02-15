<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getHeatsAttribute(){
        $arr = explode('_', $this->heat);
        return $arr;
    }
    public function getViolencesAttribute(){
        $arr = explode('_', $this->violence);
        return $arr;
    }
}
