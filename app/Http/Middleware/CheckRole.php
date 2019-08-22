<?php

// custom middle ware not defualt
namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        // Law unuser
        if($request->user() === null)
        {
            return redirect('/access-denied');
        }

        //rabt route m3 middleware and get roles from route
        $actions = $request->route()->getAction();
        $roles= isset($actions['roles']) ? $actions['roles'] : null;

        //check user have roles or not // hasAnyRole is function on user model
        if($request->user()->hasAnyRole($roles) || !$roles)
        {

               return $next($request);

        }


               return redirect('/access-denied');


     
    }



}
