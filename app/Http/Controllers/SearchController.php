<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class SearchController extends Controller
{
    public function index()
    {
        return view('search.search');
    }
    public function search(Request $request)
    {
        $user = Auth::user();
        if($request->ajax())
        {
            $output="";
            $tickets=DB::table('customers')->select('id','first_name','last_name','email','contact')->where($request->field,'LIKE','%'.$request->search."%")->get();
            if($tickets)
            {
                foreach ($tickets as $key => $ticket) {
                $output.='<tr>'.
                '<td>'.$ticket->id.'</td>'.
                '<td>'.$ticket->first_name.' '.$ticket->last_name.'</td>'.
                '<td>'.hideEmail($ticket->email).'</td>'.
                '<td>'.hidecontact($ticket->contact).'</td>';
                if($user->hasRole('sales')){
                    $output.='<td><a class="btn btn-info" href="'.route('list',$ticket->id).'">View</a> <a class="btn btn-info" href="'.route('ticketonly',$ticket->id).'">Create New Ticket</a></td>'.
                    '</tr>';
                }else{
                    $output.='<td><a class="btn btn-info" href="'.route('list',$ticket->id).'">View</a></td></tr>';
                }
                }
            return Response($output);
            }
        }
    }

}
