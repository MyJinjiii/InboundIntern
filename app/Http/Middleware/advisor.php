<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class advisor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route("login");
        }

        $usertype = auth::user()->user_type;

        if ($usertype == 'superadmin') {
            return redirect()->route('superadmintest');
        } elseif ($usertype == 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($usertype == 'advisor') {
            return $next($request);
        } elseif ($usertype == 'user') {
            return redirect()->route('index');
        }
    }
}
