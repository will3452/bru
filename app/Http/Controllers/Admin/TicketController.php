<?php

namespace App\Http\Controllers\Admin;

use App\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware(['auth:admin', 'checkrole:ticket']);
    }
    public function index()
    {
        if(request()->has('closed')){
            $tickets = Ticket::where('status', '!=', 'pending')->get();
        }else {
            $tickets = Ticket::where('status', 'pending')->get();
        }
        
        
        return view('admin.ticket.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
        $status = 'approved';
        if(!$request->has('action')){
            if($ticket->delete != null){
                $ticket->ticketable()->delete();
            }else {
                $ticket->ticketable()->update([
                    'title'=>$ticket->title,
                    'cost'=>$ticket->cost
                ]);
            }
            $ticket->status = $status;
            $ticket->save();
        }else {
            $status = 'declined';
            $ticket->status = $status;
            $ticket->admin_reason = $request->admin_reason;
            $ticket->save();
            return redirect(route('admin.messages.create').'?email='.$ticket->user->id.'&message=<p>We have received your request to change the Title and/or Cost or your work '.$ticket->ticketable->title.'. We regret to inform you that your request has been disapproved due to the following reason/s:</p><p>'.$ticket->admin_reason.'</p><p> Should you wish to file for an appeal, please contact BRU Admin via Tech Support or email. </p><p>Thank you!</p>');
        }
        

        return back()->withSuccess('Done!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
