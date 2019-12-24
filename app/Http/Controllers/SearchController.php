<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SearchController extends Controller
{
    public function index()
    {
        return view('search.search');
    }
    public function search(Request $request)
    {
        if($request->ajax())
        {
            $output="";
            $tickets=DB::table('tickets')->select('id','name','email','contact')->where($request->field,'LIKE','%'.$request->search."%")->unique('email')->get();
            if($tickets)
            {
                foreach ($tickets as $key => $ticket) {
                $output.='<tr>'.
                '<td>'.$ticket->id.'</td>'.
                '<td>'.$ticket->name.'</td>'.
                // '<td>'.$ticket->title.'</td>'.
                '<td>'.hideEmail($ticket->email).'</td>'.
                '<td>'.hidecontact($ticket->contact).'</td>'.
                '<td><a class="btn btn-info" href="#">View</a></td>'.
                '</tr>';
                }
            return Response($output);
            }
        }
    }

}
