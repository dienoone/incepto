<?php

namespace Database\Seeders;

use App\Helpers\FakeDataHelper;
use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        Skill::factory(count(FakeDataHelper::SKILLS))->create();

        $this->command->info('✅ Skills seeded.');
    }
}
