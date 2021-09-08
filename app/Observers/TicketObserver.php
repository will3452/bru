<?php

namespace App\Observers;

use App\Ticket;

class TicketObserver
{
    public function updating(Ticket $ticket)
    {
        if ($ticket->delete == null) {
            $ticket->ticketable()->update([
                'title' => $ticket->title,
                'cost' => $ticket->cost,
            ]);
        } else {
            $ticket->ticketable()->delete();
        }
    }
}
