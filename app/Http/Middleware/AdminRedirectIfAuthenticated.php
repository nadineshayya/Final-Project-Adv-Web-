<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminRedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle($request, Closure $next): Response
    {
        if (Auth::guard('admin')->check()) {
            // Redirect to the admin dashboard or any other route you want
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}
