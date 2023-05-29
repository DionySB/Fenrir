<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class BlockUnauthorizedProfileAccess
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()){
            $user = auth()->user();
        
            if (empty($user->profile_id) && is_null($user->profile_id)) {
                if ($request->route()->getName() !== 'profile.create' && $request->route()->getName() !== 'profile.store') {
                    return response()->view('profiles.createProfileButton');
                }
            }
        }
        return $next($request);
    }
}

