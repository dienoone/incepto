<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Team;
use App\Models\Member;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        Company::all()->each(function (Company $company) {
            Team::factory(rand(2, 5))
                ->afterCreating(function (Team $team) {
                    Member::factory(rand(3, 8))->create(['team_id' => $team->id]);
                })
                ->create(['company_id' => $company->id]);
        });

        $this->command->info('✅ Teams (with members) seeded.');
    }
}
