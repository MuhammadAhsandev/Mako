<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->route($this->getHomeRoute($request->user()->userType));
    }

    private function getHomeRoute($userType): string
    {
        return match ($userType) {
            'admin' => 'admin.dashboard',
            'guru' => 'guru.dashboard',
            'orangtua' => 'orangtua.dashboard',
            'siswa' => 'siswa.dashboard',
            'walikelas' => 'waliKelas.dashboard',
            default => 'dashboard',
        };
    }
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
