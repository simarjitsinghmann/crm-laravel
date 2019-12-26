<?php
// app/Http/Controllers/ticketController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Ticket;
use App\customer;
use App\comment;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Permission;
use Auth;
use DB;
use Session;

class ticketController extends Controller {

    public function __construct() {
        $this->middleware(['auth', 'clearance'])->except('index','list','show');
    }
    
use HasRoles;   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request) {
        $user = Auth::user();
       
        if($user->hasRole('tech')){
            $tickets = ticket::where('assignedto',Auth::id())->orderby('id', 'desc')->paginate(10); //show only 5 items at a time in descending order
        }
        elseif($user->hasRole('sales')){
            $tickets = ticket::where('generatedby',Auth::id())->orderby('id', 'desc')->paginate(10); //show only 5 items at a time in descending order
        }
        else{
            $tickets = ticket::orderby('id', 'desc')->paginate(10); //show only 5 items at a time in descending order
        }
        return view('tickets.index', compact('tickets'))->with('i', ($request->input('page', 1) - 1) * 10);
    }
    public function list(Request $request,$id) {

        $user = Auth::user();
       
            $tickets = ticket::where('customer_id',$id)->orderby('id', 'desc')->paginate(10); //show only 5 items at a time in descending order
        
        return view('tickets.index', compact('tickets'))->with('i', ($request->input('page', 1) - 1) * 10);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('tickets.create');
    }
    public function createticket($id) {
        $customer = customer::findOrFail($id);
        return view('tickets.ticketonly',compact('customer'));
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
            'first_name'=>'required|max:100',
            'last_name'=>'required|max:100',
            'address1'=>'required|max:100',
            'city'=>'required|max:100',
            'country'=>'required|max:100',
            'email'=>'required|email:rfc|unique:customers',
            'contact'=>'required|min:10|numeric',
            'title'=>'required|max:100',
            'description' =>'required',
            'vendor'=>'required|max:100',
            'amount'=>'required|max:100',
            'plan'=>'required|max:100',
            ]);

        $ticketdetail['title']= $request->input('title');
        $ticketdetail['description']= $request->input('description');
        $ticketdetail['vendor']= $request->input('vendor');
        $ticketdetail['amount']= $request->input('amount');
        $ticketdetail['plan']= $request->input('plan');
        $ticketdetail['status']= 0;
        $cus_detail['first_name']=$request->input('first_name');
        $cus_detail['last_name']=$request->input('last_name');
        $cus_detail['address1']=$request->input('address1');
        $cus_detail['address2']=$request->input('address2');
        $cus_detail['city']=$request->input('city');
        $cus_detail['country']=$request->input('country');
        $cus_detail['email']=$request->input('email');
        $cus_detail['contact']=$request->input('contact');
        $ticketdetail['generatedby']=Auth::id();        
        $customer=customer::create($cus_detail);
        $ticketdetail['customer_id']=$customer['id'];
        if($customer){
            $users = Role::where('name', 'tech')->first()->users()->orderby('ticket_count','asc')->get();
            $total= $users[0]->ticket_count+1;
            $ticketdetail['assignedto']=$users[0]->id;
            if($users){
                $ticket = ticket::create($ticketdetail);
            }
            if($ticket){
                $tech_user=User::where('id',$users[0]->id)->first();
                $tech_user->ticket_count=$total;
                $tech_user->save();
            }
        }
        

    //Display a successful message upon save
        return redirect()->route('list',$customer['id'])
            ->with('flash_message', 'Ticket ,
             '. $ticket->title.' created');
    }

    public function ticketstore(Request $request) { 

        //Validating title and body field
            $this->validate($request, [
                'title'=>'required|max:100',
                'description' =>'required',
                'vendor'=>'required|max:100',
                'amount'=>'required|max:100',
                'plan'=>'required|max:100',
                ]);
    
            $ticketdetail['title']= $request->input('title');
            $ticketdetail['description']= $request->input('description');
            $ticketdetail['vendor']= $request->input('vendor');
            $ticketdetail['amount']= $request->input('amount');
            $ticketdetail['plan']= $request->input('plan');
            $ticketdetail['status']= 0;
            $ticketdetail['customer_id']=$request->input('id');
            $ticketdetail['generatedby']=Auth::id();  
            $users = Role::where('name', 'tech')->first()->users()->orderby('ticket_count','asc')->get();
            $total= $users[0]->ticket_count+1;
            $ticketdetail['assignedto']=$users[0]->id;
            echo "<pre>";
            print_r($ticketdetail);
            echo "</pre>";
            if($users){
                $ticket = ticket::create($ticketdetail);
            }
            if($ticket){
                $tech_user=User::where('id',$users[0]->id)->first();
                $tech_user->ticket_count=$total;
                $tech_user->save();
            }
            
    
        //Display a successful message upon save
            return redirect()->route('list',$ticketdetail['customer_id'])
                ->with('flash_message', 'Ticket ,
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
        $cus_d=$ticket->customer_id;
        // $comments=comment::where('ticket_id',$id)->orderby('id','desc')->get();
        $customer = customer::findOrFail($cus_d);
        return view ('tickets.show')->with(compact('ticket','customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $ticket = ticket::findOrFail($id);
        $cus_d=$ticket->customer_id;
        // $comments=comment::where('ticket_id',$id)->orderby('id','desc')->get();
        $customer = customer::findOrFail($cus_d);
        return view('tickets.edit')->with(compact('ticket','customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateticket(Request $request, $id) {
        // $this->validate($request, [
        //     'title'=>'required|max:100',
        //     'body'=>'required',
        // ]);
        $ticket = ticket::findOrFail($id);
            if($request->solution){
                $ticket->solution = $request->solution;
            }
            if($request->feedback){
                $ticket->feedback = $request->feedback;
                $ticket->rating = $request->rating;
            }
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