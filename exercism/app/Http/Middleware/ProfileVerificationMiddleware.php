<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ProfileVerificationMiddleware
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user && $user->profile_id === null && $request->route()->getName() !== 'profile.create') {
            return redirect()->route('profile.create');
        }

        return $next($request);
    }
}
