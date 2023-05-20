<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $roleIds = ['usercode' => "User", 'seller' => 'Seller', 'admin' => 'Admin'];
        $allowedRoleIds = [];
        foreach ($roles as $role)
        {
           if(isset($roleIds[$role]))
           {
               $allowedRoleIds[] = $roleIds[$role];
           }
        }
        $allowedRoleIds = array_unique($allowedRoleIds); 
    if(!Auth::check()){
        return redirect('/login');
    }
    else{
         if(Auth::check()) {
          if(in_array(Auth::user()->user_role_code, $allowedRoleIds)) {
            return $next($request);
          }
        }

        return redirect('/Iferror');
    }
       

    }
}
