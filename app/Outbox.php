<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outbox extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function outboxable(){
        return $this->morphTo();
    }

    //helper
    public function i_receiver(){
        return User::find($this->to_id);
    }
}
