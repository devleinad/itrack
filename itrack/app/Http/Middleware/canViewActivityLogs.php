<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Policies\ActivityLogPolicy;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;


class canViewActivityLogs
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!(Auth::check() && Auth::user()->isSuperAdmin())) {
            return back()->with('error', 'You are not authorized to access that page!');
        }
        return $next($request);
    }
}
