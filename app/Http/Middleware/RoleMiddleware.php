<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();

        if (! $user) {
            return Redirect::route('login');
        }

        // Handle both comma-separated in string (if using '|') or variadic array (if using ',')
        $allowed = [];
        foreach ($roles as $role) {
            $allowed = array_merge($allowed, array_filter(preg_split('/[,|]/', $role)));
        }

        if (! in_array($user->role, $allowed, true)) {
            abort(403, 'Akses ditolak.');
        }

        return $next($request);
    }
}
