<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ClearanceMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {        
    //     if (Auth::user()->hasPermissionTo('Administer roles & permissions')) //If user has this //permission
    // {
    //         return $next($request);
    //     }
        if ($request->is('tickets/index'))//If user is creating a post
            {
            if (!Auth::user()->hasPermissionTo('ticket list'))
            {
                abort('401');
            } 
            else {
                return $next($request);
            }
        }
        if ($request->is('tickets/create'))//If user is creating a post
         {
            if (!Auth::user()->hasPermissionTo('ticket create'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }

        if ($request->is('tickets/*/edit')) //If user is editing a post
         {
            if (!Auth::user()->hasPermissionTo('ticket edit')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->isMethod('Delete')) //If user is deleting a post
         {
            if (!Auth::user()->hasPermissionTo('ticket delete')) {
                abort('401');
            } 
         else 
         {
                return $next($request);
            }
        }

        return $next($request);
    }
}