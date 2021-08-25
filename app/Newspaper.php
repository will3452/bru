<?php

namespace App;

use App\Traits\Marketable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newspaper extends Model
{
    use HasFactory, Marketable;
    protected $guarded = [];

    public function pages()
    {
        return $this->hasMany(Newspage::class, 'newspaper_id');
    }

    public function market()
    {
        return $this->belongsTo(Market::class, 'market_id');
    }
}
