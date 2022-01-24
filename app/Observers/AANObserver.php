<?php

namespace App\Observers;

use App\AAN;

class AANObserver
{
    public function creating(AAN $aan)
    {

        $aan->admin_id = auth()->id();
        $aan->complete = now()->format('ydm') . str_pad(AAN::count(), 8, '0', STR_PAD_LEFT);
    }
}
