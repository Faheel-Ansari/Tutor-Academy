<?php

namespace App\Http\Controllers\Auth;

use App\Models\Logo;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        $logo = Logo::first();
        return view('auth.login', compact('logo'));
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        if ($request->user()->status == '0') {

            Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect('/login')->with('status', 'suspend');
        }
        switch (Auth::user()->role) {
            case 'admin':
                return redirect()->intended('/admin/dashboard')->with(['message' => 'Admin Login Successfully', 'alert-type' => 'success']);
                break;
            case 'teacher':
                return redirect()->intended('/teacher/dashboard')->with(['message' => 'Teacher Login Successfully', 'alert-type' => 'success']);
                break;
            case 'student':
                if (Auth::user()->email_verified_at == null) {
                    return redirect()->intended('/verify-email');
                }
                return redirect()->intended('/')->with(['message' => 'Student Login Successfully', 'alert-type' => 'success']);
                break;
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

        return redirect(route('login'));
    }
}
