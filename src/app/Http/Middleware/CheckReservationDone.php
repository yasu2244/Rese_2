<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckReservationDone
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if ($request->is('reservation/done')) {
            $request->session()->put('reservation_done', true);
        }

        return $next($request);
    }
}
