<?php

namespace App\Http\Middleware;

use Auth;
use Config;
use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request the aplication request
     * @param \Closure                 $next    Closure instance
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $roles = $this->getRequiredRoles($request->route());
        if (Auth::user()->hasRole($roles) || !$roles) {
            return $next($request);
        }
        abort(Config::get('common.HTTP_UNAUTHORIZED'), trans('backend.common.insufficient_role'));
    }

    /**
     * Get the required roles from the route
     *
     * @param \Illuminate\Database\Eloquent\Collection $route the route
     *
     * @return array
     */
    private function getRequiredRoles($route)
    {
        $actions = $route->getAction();
        return isset($actions['roles']) ? $actions['roles'] : null;
    }
}
