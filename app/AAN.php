<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AAN extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'aans';

    //attributes
    public function getActiveAttribute()
    {
        if ($this->user()->count()) {
            return true;
        }
        return false;
    }

    //relatiions
    public function user()
    {
        return $this->hasOne(User::class, 'aan_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
