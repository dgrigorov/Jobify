<?php

namespace App\Http\Middleware;

use Closure;
use App\Account;
use App\AccountRoles;
use Illuminate\Support\Facades\Auth;

class DashboardRedirect
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
        $action = $request->route()->getAction();
        $actionName = $this->getRoleName($request);
        $namespace = 'App\\Http\\Controllers';
        $action['namespace'] = $namespace;
        $action['controller'] = "$namespace\\DashboardController@$actionName";
        $action['uses'] = $action['controller'];
        $request->route()->setAction($action);
        
        return $next($request);
    }

    function getRoleName($request)
    {
        $account = $request->user();
        switch ($account->role) {
            case AccountRoles::Administrator:
                return 'administrator';
            case AccountRoles::User:
                return 'user';
            case AccountRoles::Company:
                return 'company';
        }
    }
}
