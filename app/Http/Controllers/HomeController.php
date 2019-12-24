<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Collection;
use Auth;
use App\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        // $roles=Auth::user()->roles()->get();
        // $firstRole = $this->roles->first();
        $user = Auth::user();
       
        if($user->hasRole('superadmin')){
            return \Redirect::route('users.index');
        }
        elseif($user->hasRole('tech')){
            return \Redirect::route('tickets.index');
        }
        else{
            return \Redirect::route('search');
        }
    }
}
