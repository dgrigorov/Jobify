<?php

namespace App\Http\Middleware;

use Closure;
use App\Account;
use App\AccountRoles;
use Illuminate\Support\Facades\Auth;

class RedirectIfAdministratorExist
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
        $adminExist = Account::where('role', AccountRoles::Administrator)->exists();
        if ($adminExist) {
            return redirect('/dashboard');
        }

        return $next($request);
    }
}
