<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function from(){
        return $this->belongsTo(User::class, 'from_id');
    }

    public function to(){
        return $this->belongsTo(User::class, 'to_id');
    }
}
