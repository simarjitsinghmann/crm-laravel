<?php
// app/Http/Controllers/ticketController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ticket;
use Auth;
use Session;

class ticketController extends Controller {

    public function __construct() {
        $this->middleware(['auth', 'clearance'])->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index() {
        $tickets = ticket::orderby('id', 'desc')->paginate(5); //show only 5 items at a time in descending order

        return view('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) { 

    //Validating title and body field
        $this->validate($request, [
            'title'=>'required|max:100',
            'body' =>'required',
            ]);

        $title = $request['title'];
        $body = $request['body'];

        $ticket = ticket::create($request->only('title', 'body'));

    //Display a successful message upon save
        return redirect()->route('tickets.index')
            ->with('flash_message', 'Article,
             '. $ticket->title.' created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $ticket = ticket::findOrFail($id); //Find ticket of id = $id

        return view ('tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $ticket = ticket::findOrFail($id);

        return view('tickets.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $this->validate($request, [
            'title'=>'required|max:100',
            'body'=>'required',
        ]);

        $ticket = ticket::findOrFail($id);
        $ticket->title = $request->input('title');
        $ticket->body = $request->input('body');
        $ticket->save();

        return redirect()->route('tickets.show', 
            $ticket->id)->with('flash_message', 
            'Article, '. $ticket->title.' updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $ticket = ticket::findOrFail($id);
        $ticket->delete();

        return redirect()->route('tickets.index')
            ->with('flash_message',
             'Article successfully deleted');

    }
}