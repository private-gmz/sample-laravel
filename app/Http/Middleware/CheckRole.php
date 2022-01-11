<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        $allroles = \App\Helpers\Helpers::get_roles();
        foreach ($allroles as $one_role) {
            if ($role == $one_role->name && auth()->user()->role_id != $one_role->id) {
                abort(403);
            }

        }
        return $next($request);
    }
}
