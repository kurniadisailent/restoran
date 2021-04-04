<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
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
        if ($request->is('admin/*')) {
            if (Auth::guard('admin')->check()) {
                return redirect('admin/dashboard');
            }
        } elseif ($request->is('pelanggan/*')) {
            if (Auth::guard('pelanggan')->check()) {
                return redirect('pelanggan/home');
            }
        } elseif ($request->is('waiter/*')) {
            if (Auth::guard('waiter')->check()) {
                return redirect('waiter/order');
            }
        } elseif ($request->is('kasir/*')) {
            if (Auth::guard('kasir')->check()) {
                return redirect('kasir/order');
            }
        } elseif ($request->is('owner/*')) {
            if (Auth::guard('owner')->check()) {
                return redirect('owner/dashboard');
            }
        }
        // elseif($request->is('/*')) {
        //     if (Auth::guard('pemilih')->check()) 
        //     {
        //         return redirect()->route('voting');
        //     } 
        // }
        return $next($request);
    }
}
