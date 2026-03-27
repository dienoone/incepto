<?php

namespace Database\Seeders;

use App\Models\Attachment;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Seeker;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeekerSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $skillIds = Skill::pluck('id')->toArray();

        User::factory(20)
            ->seeker()
            ->afterCreating(function (User $user) use ($skillIds) {
                $seeker = Seeker::factory()->create(['user_id' => $user->id]);

                Education::factory(rand(1, 5))->create(['seeker_id' => $seeker->id]);
                Experience::factory(rand(1, 5))->create(['seeker_id' => $seeker->id]);
                Attachment::factory(rand(1, 5))->create(['seeker_id' => $seeker->id]);

                $seeker->skills()->attach(
                    collect($skillIds)->random(rand(2, 10))->toArray()
                );
            })
            ->create();

        $this->command->info('✅ Seekers (with education, experience, attachments, skills) seeded.');
    }
}
