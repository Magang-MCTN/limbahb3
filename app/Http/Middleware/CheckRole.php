<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle($request, Closure $next, $role)
    {
        if ($request->user() && $request->user()->id_role == $role) {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}
