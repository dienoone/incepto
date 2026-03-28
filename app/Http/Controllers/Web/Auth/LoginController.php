<?php

namespace App\Http\Controllers\Web\Auth;

use App\Enums\RoleType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function __construct(protected AuthService $authService) {}

    public function index(): View|RedirectResponse
    {
        if (Auth::check()) {
            return $this->redirectByRole();
        }

        return view('pages.auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        if (!$this->authService->login($request->validated())) {
            return back()
                ->withInput($request->only('email', 'remember'))
                ->with('error', 'These credentials do not match our records');
        }

        $request->session()->regenerate();

        return $this->redirectByRole()
            ->with('success', 'Welcome back, ' . Auth::user()->first_name . '!');
    }

    public function logout(): RedirectResponse
    {
        $this->authService->logout();

        return redirect()->route('login')
            ->with('success', 'You have been signed out.');
    }

    protected function redirectByRole(): RedirectResponse
    {
        return match (Auth::user()->role) {
            RoleType::COMPANY => redirect()->intended(route('home')),
            RoleType::ADMIN   => redirect()->intended(route('home')),
            default       => redirect()->intended(route('home')),
        };
    }
}
