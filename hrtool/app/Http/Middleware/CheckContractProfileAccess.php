<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckContractProfileAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        $userId = $request->route('id');

        if ($user->hasRole('admin_hr') || ($user->hasRole('user') && $user->id == $userId) || ($user->hasRole('admin_it') && $user->id == $userId)) {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}
