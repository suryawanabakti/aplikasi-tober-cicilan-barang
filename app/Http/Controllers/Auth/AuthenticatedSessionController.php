<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
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

        if (auth()->user()->roles[0]->name === 'admin' || auth()->user()->roles[0]->name === 'super-admin') {
            return redirect()->intended(RouteServiceProvider::ADMIN_DASHBOARD);
        } elseif (auth()->user()->roles[0]->name === 'customer') {
            return redirect()->intended(RouteServiceProvider::CUSTOMER_DASHBOARD);
        } elseif (auth()->user()->roles[0]->name === 'pimpinan') {
            return redirect()->intended(RouteServiceProvider::PIMPINAN_DASHBOARD);
        }
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
