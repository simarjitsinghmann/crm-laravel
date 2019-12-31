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
        $this->middleware(['auth', 'clearance'])->except('list','show');
    }
    
use HasRoles;   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request) {
        $user = Auth::user();
       
        if($user->hasRole('superadmin')){
            $tickets = Ticket::orderby('id', 'desc')->paginate(10); //show only 5 items at a time in descending order
            return view('tickets.index', compact('tickets'))->with('i', ($request->input('page', 1) - 1) * 10);
        }
        elseif($user->hasRole('tech')){
            $tickets = ticket::where('tech_id',Auth::id())->where('status',0)->orderby('id', 'desc')->paginate(10); //show only 5 items at a time in descending order
            return view('tickets.index', compact('tickets'))->with('i', ($request->input('page', 1) - 1) * 10);
        }
        elseif($user->hasRole('customer')){
            $tickets = ticket::where('status',1)->orderby('id', 'desc')->paginate(10); //show only 5 items at a time in descending order
            return view('tickets.index', compact('tickets'))->with('i', ($request->input('page', 1) - 1) * 10);
        }
        else{
            return redirect()->route('home');
        }
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
        $ticketdetail['sales_id']=Auth::id();        
        $customer=customer::create($cus_detail);
        $ticketdetail['customer_id']=$customer['id'];
        if($customer){
            $users = Role::where('name', 'tech')->first()->users()->orderby('ticket_count','asc')->get();
            $total= $users[0]->ticket_count+1;
            $ticketdetail['tech_id']=$users[0]->id;
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
            $ticketdetail['sales_id']=Auth::id();  
            $users = Role::where('name', 'tech')->first()->users()->orderby('ticket_count','asc')->first();
            $total= $users->ticket_count+1;
            $ticketdetail['tech_id']=$users->id;
            if($users){
                $ticket = ticket::create($ticketdetail);
            }
            if($ticket){
                $tech_user=User::where('id',$users->id)->first();
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
        $sales_id=$ticket->sales_id;
        $tech_id=$ticket->tech_id;
        $csupport_id=$ticket->csupport_id;
        // $comments=comment::where('ticket_id',$id)->orderby('id','desc')->get();
        $customer = customer::findOrFail($cus_d);
        $sales = User::where('id',$sales_id)->first();
        $tech = User::where('id',$tech_id)->first();
        $csupport = User::where('id',$csupport_id)->first();
        return view ('tickets.show')->with(compact('ticket','customer','sales','tech','csupport'));
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
        $user = Auth::user();
        $users = Role::where('name', 'customer')->first()->users()->orderby('ticket_count','asc')->first();
        $total= $users->ticket_count+1;
        if($user->hasRole('tech')){
               $ticket->solution = $request->solution;
               $ticket->status=1;
               $ticket->csupport_id=$users->id;
               $tickets=$ticket->save();
               if($tickets){
                    $cus_user=User::where('id',$users->id)->first();
                    $cus_user->ticket_count=$total;
                    $cus_user->save();
               }
         }
        elseif($user->hasRole('customer')){
                $ticket->feedback = $request->feedback;
                $ticket->rating = $request->rating;
                $ticket->status=2;
                $tickets=$ticket->save();
                if($tickets){
                        $cus_user=User::where('id',$users->id)->first();
                        $cus_user->ticket_count=$total;
                        $cus_user->save();
                }
            }


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
    public function latest(Request $request) {
        $user = Auth::user();
        if($request->ajax())
        {
            if($request->role=='tech'){
                $role='tech_id';
                $status='0';
            }
            elseif($request->role=='customer'){
                $role='csupport_id';
                $status='1';
            }
            $output=$request->count;
            $tickets=Ticket::where($role,$request->search)->count();
            if($tickets > $output){
                $ticket=Ticket::where($role,$request->search)->where('status','1')->orderby('id','desc')->first();
                $data['output']='<div class="modals_pop bg-primary text-white">
                <button type="button" class="close closebtn" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                <p>New Ticket Issued</p>
                <a href="'.route('tickets.show',$ticket->id).'">View Ticket Here</a></div>';
                $data['count']=$tickets;
                $output=$tickets;
                return Response($data);
            }else{
                return Response('no'); 
            }
        }
    }
    public function filterlist(Request $request)
    {
        if($request->ajax())
        {
            $i=0;
            $output='';
            $solved=0;
            // $tickets=DB::table('tickets')->select('id','title','description','status')->where('created_at', '=', date('Y-'.$request->search.'-d').' 00:00:00')->get();
            if($request->role=='tech'){
                $role='tech_id';
            }
            elseif($request->role=='sales'){
                $role='sales_id';
            }
            elseif($request->role=='customer'){
                $role='csupport_id';
            }
            $tickets=Ticket::whereMonth('created_at', $request->month)->whereYear('created_at', $request->year)->where($role,$request->id)->get();
            $data['count'] = count($tickets);
            if($data['count']>0){
                foreach ($tickets as $key => $ticket) {
                    if($request->role=='tech'){
                        if($ticket->status==1||$ticket->status==2){
                            $solved=$solved+1;
                        }
                    }
                    elseif($request->role=='customer'){
                        if($ticket->status==2){
                            $solved=$solved+1;
                        }
                    }
                    $output.= '<tr>'.
                    '<td>'.++$i.'</td>'.
                    '<td>'.$ticket->created_at->format('d-m-Y').'</td>'.
                    '<td>'.$ticket->title.'</td>'.
                    '<td>'.$ticket->description.'</td>';
                    if($ticket->solution!=''){
                        $output.='<td>'.$ticket->solution.'</td>';
                        }
                        else{
                            $output.='<td>Pending</td>';
                        }
                    
                    if($ticket->feedback!=''){
                        $output.='<td>'.$ticket->feedback.'</td>';
                    }
                    else{
                        $output.='<td><strike>No Feedback</strike></td>';
                    }  
                    
                    if($ticket->status==2){
                    $output.='<td>Closed</td>';
                    }
                    else{
                        $output.='<td>Pending</td>';
                    }
                    if($ticket->status==2){
                        $output.='<td>'.$ticket->rating.'/10 </td></tr>';
                    }
                    else{
                        $output.='<td><strike>No Rating</strike></td></tr>';
                    }                
                }
                $data['output']=$output;
                if($request->role=='tech'){
                    $data['solved']='<span>Total Tickets Issued :- <strong>'.count($tickets).'</strong> </span><span> Ticket Solved  :- <strong>'.$solved.'</strong> </span>';
                }
                elseif($request->role=='sales'){
                    $data['solved']='<span>Total Tickets Generated :- <strong>'.count($tickets).'</strong> </span>';
                }
                elseif($request->role=='customer'){
                    $data['solved']='<span>Total Tickets Issued :- <strong>'.count($tickets).'</strong> </span><span> Ticket Solved  :- <strong>'.$solved.'</strong> </span>';
                }
                return Response($data);
            }
            else{
                return Response('no');
            }
        }
    }
}