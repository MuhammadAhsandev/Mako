<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthUser
{
    private function getDefaultRoute(?string $userType): string{
        return match($userType){
            'admin' => 'admin.dashboard',
            'guru' => 'guru.dashboard',
            'orangtua' => 'orangtua.dashboard',
            'siswa' => 'siswa.dashboard',
            default => 'login'
        };
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $userType): Response
    {
        if (!Auth::check() || Auth::user()->userType !== $userType) {
            // Redirect to their appropriate dashboard based on role
            return redirect()->route($this->getDefaultRoute(Auth::user()->userType));
        }
        return $next($request);
    }
}
