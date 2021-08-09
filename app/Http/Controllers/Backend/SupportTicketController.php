<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use App\Http\Controllers\Controller;
use App\Ticket;
use App\TicketReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportTicketController extends BackendController
{
    public function index()
    {
        $tickets = Ticket::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(9);
        return view($this->_mainpages.'support_tickets.index', compact('tickets'));
    }

    public function admin_index(Request $request)
    {
        $sort_search = null;
        $tickets = Ticket::orderBy('created_at', 'desc');
        if ($request->has('search')) {
            $sort_search = $request->search;
            $tickets = $tickets->where('code', 'like', '%' . $sort_search . '%');
        }
        $tickets = $tickets->paginate(15);
        return view($this->_mainpages . 'support_tickets.index', compact('tickets', 'sort_search'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd();
        $ticket = new Ticket;
        $ticket->code = max(100000, (Ticket::latest()->first() != null ? Ticket::latest()->first()->code + 1 : 0)) . date('s');
        $ticket->user_id = Auth::user()->id;
        $ticket->subject = $request->subject;
        $ticket->details = $request->details;

        $files = array();

        if ($request->hasFile('attachments')) {
            foreach ($request->attachments as $key => $attachment) {
                $item['name'] = $attachment->getClientOriginalName();
                $item['path'] = $attachment->store('uploads/support_tickets/');
                array_push($files, $item);
            }
            $ticket->files = json_encode($files);
        }

        if ($ticket->save()) {
            return redirect()->route('support_ticket.index')->with('status', 'Ticket has been created successfully !!');
        } else {
            return redirect()->back()->with('error', 'Something Went Wrong !');
        }
    }

    public function admin_store(Request $request)
    {
        //dd($request->all());
        $ticket_reply = new TicketReply;
        $ticket_reply->ticket_id = $request->ticket_id;
        $ticket_reply->user_id = Auth::user()->id;
        $ticket_reply->reply = $request->reply;

        $files = array();

        if ($request->hasFile('attachments')) {
            foreach ($request->attachments as $key => $attachment) {
                $item['name'] = $attachment->getClientOriginalName();
                $item['path'] = $attachment->store('uploads/support_tickets/');
                array_push($files, $item);
            }
            $ticket_reply->files = json_encode($files);
        }

        $ticket_reply->ticket->client_viewed = 0;
        $ticket_reply->ticket->status = $request->status;
        $ticket_reply->ticket->save();
        if ($ticket_reply->save()) {

            return back()->with('status', 'Reply Sent !!');
        } else {
            return back()->with('error', 'Something Went Wrong !');
        }
    }

    public function seller_store(Request $request)
    {
        $ticket_reply = new TicketReply;
        $ticket_reply->ticket_id = $request->ticket_id;
        $ticket_reply->user_id = $request->user_id;
        $ticket_reply->reply = $request->reply;

        $files = array();

        if ($request->hasFile('attachments')) {
            foreach ($request->attachments as $key => $attachment) {
                $item['name'] = $attachment->getClientOriginalName();
                $item['path'] = $attachment->store('uploads/support_tickets/');
                array_push($files, $item);
            }
            $ticket_reply->files = json_encode($files);
        }

        $ticket_reply->ticket->viewed = 0;
        $ticket_reply->ticket->status = 'pending';
        $ticket_reply->ticket->save();
        if ($ticket_reply->save()) {
            return back()->with('status', 'Reply has been sent successfully !');
        } else {

            return back()->with('error', 'Something Went Wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::findOrFail(decrypt($id));
        $ticket->client_viewed = 1;
        $ticket->save();
        $ticket_replies = $ticket->ticketreplies;
     //   return view($this->_mainpages . 'support_ticket.show', compact('ticket', 'ticket_replies'));
    }

    public function admin_show($id)
    {
        $ticket = Ticket::findOrFail(decrypt($id));
        $ticket->viewed = 1;
        $ticket->save();
        return view($this->_mainpages.'support_tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
