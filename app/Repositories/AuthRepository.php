<?php

namespace App\Repositories;

use App\Models\Company;
use App\Models\Seeker;
use App\Models\User;
use Illuminate\Support\Str;

class AuthRepository
{
    public function createUser(array $data): User
    {
        return User::create([
            'first_name' => data_get($data, 'first_name'),
            'last_name' => data_get($data, 'last_name'),
            'email' => data_get($data, 'email'),
            'password' => data_get($data, 'password'),
            'role' => data_get($data, 'role'),
        ]);
    }

    public function createSeeker(User $user, array $data): Seeker
    {
        return Seeker::create([
            'user_id' => $user->id,
            'phone' => data_get($data, 'phone', ''),
            'bio' => data_get($data, 'bio', ''),
            'avatar' => data_get($data, 'avatar', ''),
        ]);
    }


    public function createCompany(User $user, array $data): Company
    {
        return Company::create([
            'user_id' => $user->id,
            'name' => data_get($data, 'company_name'),
            'slug' => Str::slug(data_get($data, 'company_name') . '-' . $user->id),
            'bio'          => '',
            'website'      => '',
            'industry'     => '',
            'address'      => '',
            'founded_year' => date('Y'),
            'funding'      => '0',
            'revenue_min'  => 0,
            'revenue_max'  => 0,
            'company_size' => '1-10',
        ]);
    }

    public function findUserByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }
}
