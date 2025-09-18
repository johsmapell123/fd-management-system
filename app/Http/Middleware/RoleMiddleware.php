<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$positions): Response
    {
        if (!Auth::check()) return redirect()->route('login');

        $userPosition = Auth::user()->position;

        if (!in_array($userPosition, $positions, true)) {
            abort(403, 'Access denied. ' . $positions[0] . ' only.');
        }

        Log::info('Checking role middleware', ['expected' => $positions, 'actual' => Auth::user()->position]);

        return $next($request);
    }
}
