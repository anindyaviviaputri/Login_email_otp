<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request; // Tambahkan ini
use Illuminate\Support\Facades\Auth;

class EnsureUserIsVerified
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::user()->is_verified) {
            return redirect()->route('otp.verify');
        }

        return $next($request);
    }
}