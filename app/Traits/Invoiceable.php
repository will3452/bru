<?php

namespace App\Traits;

use App\Invoice;

trait Invoiceable
{
    public function invoice()
    {
        return $this->morphOne(Invoice::class, 'invoiceable');
    }
}
