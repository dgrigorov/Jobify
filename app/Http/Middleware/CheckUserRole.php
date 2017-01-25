<?php

namespace App\Http\Middleware;

use Closure;
use App\Account;
use App\AccountRoles;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
        /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $account = Auth::user();
        if ($account->role !== intval($role))
        {
            return redirect('/');
        }
        
        return $next($request);
    }
}
