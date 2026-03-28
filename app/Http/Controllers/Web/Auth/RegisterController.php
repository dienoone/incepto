<?php

namespace App\Http\Controllers\Web\Auth;

use App\Services\AuthService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Enums\RoleType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function __construct(
        protected AuthService $authService
    ) {}

    public function index(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('pages.auth.register');
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        $user = $this->authService->register($request->validated());

        Auth::login($user);

        $message = $user->role === RoleType::COMPANY
            ? 'Welcome! Your employer account is ready. Complete your company profile to start hiring.'
            : 'Welcome to Incepto! Start exploring thousands of opportunities.';

        return match ($user->role) {
            RoleType::COMPANY => redirect()->route('home')->with('success', $message),
            default => redirect()->route('home')->with('success', $message),
        };
    }
}
