<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Follow;
use App\Models\Review;
use App\Models\Seeker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanyInteractionSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $companies = Company::all();
        $seekerIds = Seeker::pluck('id')->toArray();

        foreach ($companies as $company) {

            foreach (collect($seekerIds)->random(rand(2, min(5, count($seekerIds)))) as $seekerId) {
                Review::factory()->create([
                    'seeker_id'  => $seekerId,
                    'company_id' => $company->id,
                ]);
            }

            foreach (collect($seekerIds)->random(rand(2, min(5, count($seekerIds)))) as $seekerId) {
                Follow::factory()->create([
                    'seeker_id'  => $seekerId,
                    'company_id' => $company->id,
                ]);
            }
        }

        $this->command->info('✅ Company interactions (reviews, followers) seeded.');
    }
}
