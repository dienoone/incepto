<?php

namespace App\Services;

use App\Enums\RoleType;
use App\Models\User;
use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthService
{
    public function __construct(protected AuthRepository $repo) {}

    public function register(array $data): User
    {
        return DB::transaction(function () use ($data) {
            $user = $this->repo->createUser($data);

            if ($user->role === RoleType::SEEKER) {
                $this->repo->createSeeker($user, $data);
            }

            if ($user->role === RoleType::COMPANY) {
                $this->repo->createCompany($user, $data);
            }

            return $user;
        });
    }

    public function login(array $credentials): bool
    {
        return Auth::attempt([
            'email'    => $credentials['email'],
            'password' => $credentials['password'],
        ], $credentials['remember'] ?? false);
    }

    public function logout(): void
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }

    public function currentUser(): ?User
    {
        return Auth::user();
    }
}
