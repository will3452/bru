<?php

namespace App\Traits;

trait Marketable
{
    public function scopeAdmin($query)
    {
        return $query->whereHas('market');
    }
}
