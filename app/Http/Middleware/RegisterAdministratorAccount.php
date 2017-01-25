<?php

namespace App\Http\Middleware;

use Closure;
use \App\Account;
use \App\AccountRoles;
use Illuminate\Support\Facades\Auth;

class RegisterAdministratorAccount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (!Auth::guard($guard)->check()) {
            $adminExist = Account::where('role', AccountRoles::Administrator)->exists();
            if (!$adminExist) {
                return redirect('/register/administrator');
            }
        }

        return $next($request);
    }
}
