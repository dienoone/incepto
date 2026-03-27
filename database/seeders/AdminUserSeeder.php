<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::factory()->admin()->create([
            'first_name' => 'workopia',
            'last_name'  => 'admin',
            'email'      => 'admin@workopia.com',
            'password'   => Hash::make('workopia'),
        ]);

        $this->command->info('✅ Admin user seeded.');
    }
}
