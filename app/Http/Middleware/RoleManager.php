<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role != $role) {
                if ($user->role == 0) {
                    return redirect()->route('admin.index');
                } elseif ($user->role == 1) {
                    return redirect()->route('client.index');
                }
            }
        } else {
            // dd($role);
            if ($role == 0) {
                return redirect()->route('admin.login');
            } elseif ($role == 1) {
                return redirect()->route('front.login');
            }
        }

        return $next($request);
    }
}
