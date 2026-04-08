<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class AdminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (!Session::has('admin_logged_in')) {
            return redirect()->route('admin.login')->withErrors('Silakan login terlebih dahulu.');
        }
        return $next($request);
    }
}
