<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminAuthController extends Controller
{
    public function showLogin(): View|RedirectResponse
    {
        if (session('admin_authenticated') === true) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $adminEmail = (string) env('ADMIN_EMAIL', 'bbonsportswear@gmail.com');
        $adminPassword = (string) env('ADMIN_PASSWORD', 'admin123');

        $emailMatches = hash_equals(strtolower($adminEmail), strtolower($validated['email']));
        $passwordMatches = hash_equals($adminPassword, $validated['password']);

        if (! $emailMatches || ! $passwordMatches) {
            return back()
                ->withErrors(['email' => 'These admin credentials are incorrect.'])
                ->onlyInput('email');
        }

        $request->session()->regenerate();
        $request->session()->put('admin_authenticated', true);

        return redirect()->route('admin.dashboard')->with('status', 'Welcome back.');
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->forget('admin_authenticated');
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('status', 'Logged out.');
    }
}
