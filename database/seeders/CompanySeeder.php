<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\CompanyImage;
use App\Models\Detail;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::factory(5)
            ->company()
            ->afterCreating(function (User $user) {
                $company = Company::factory()->create(['user_id' => $user->id]);

                Detail::factory()
                    ->mission()
                    ->count(rand(3, 5))
                    ->for($company, 'detailable')
                    ->create();

                Detail::factory()
                    ->benefit()
                    ->count(rand(3, 5))
                    ->for($company, 'detailable')
                    ->create();

                CompanyImage::factory(rand(3, 5))->create(['company_id' => $company->id]);
            })
            ->create();

        $this->command->info('✅ Companies (with missions, benefits, images, members) seeded.');
    }
}
