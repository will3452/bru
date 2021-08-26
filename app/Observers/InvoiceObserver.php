<?php

namespace App\Observers;

use App\Invoice;

class InvoiceObserver
{
    /**
     * Handle the invoice "created" event.
     *
     * @param  \App\Invoice  $invoice
     * @return void
     */
    public function created(Invoice $invoice)
    {
        Mail::raw('New Invoice has been created! ID: ' . $invoice->id, function ($message) {
            // $message->to(config('app.payment_email_handler'));
            $message->to('williamgalas2@gmail.com');
        });
    }

    /**
     * Handle the invoice "updated" event.
     *
     * @param  \App\Invoice  $invoice
     * @return void
     */
    public function updated(Invoice $invoice)
    {
        //
    }

    /**
     * Handle the invoice "deleted" event.
     *
     * @param  \App\Invoice  $invoice
     * @return void
     */
    public function deleted(Invoice $invoice)
    {
        //
    }

    /**
     * Handle the invoice "restored" event.
     *
     * @param  \App\Invoice  $invoice
     * @return void
     */
    public function restored(Invoice $invoice)
    {
        //
    }

    /**
     * Handle the invoice "force deleted" event.
     *
     * @param  \App\Invoice  $invoice
     * @return void
     */
    public function forceDeleted(Invoice $invoice)
    {
        //
    }
}
