<?php

namespace App\Traits;

trait Eventable
{
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
