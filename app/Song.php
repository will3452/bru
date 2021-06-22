<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Song extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function tickets()
    {
        return $this->morphMany(Ticket::class, 'ticketable');
    }

    public function collections()
    {
        return $this->morphToMany(Collection::class, 'collectionable');
    }
}
