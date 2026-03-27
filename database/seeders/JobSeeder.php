<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Bookmark;
use App\Models\Company;
use App\Models\Detail;
use App\Models\Job;
use App\Models\Seeker;
use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $companies = Company::all();
        $seekerIds = Seeker::pluck('id')->toArray();
        $skillIds = Skill::pluck('id')->toArray();

        foreach ($companies as $company) {
            Job::factory(rand(5, 10))
                ->afterCreating(function (Job $job) use ($seekerIds, $skillIds) {

                    Detail::factory()
                        ->requirement()
                        ->count(rand(3, 5))
                        ->for($job, 'detailable')
                        ->create();

                    Detail::factory()
                        ->responsibility()
                        ->count(rand(3, 5))
                        ->for($job, 'detailable')
                        ->create();

                    Detail::factory()
                        ->benefit()
                        ->count(rand(3, 5))
                        ->for($job, 'detailable')
                        ->create();

                    $job->skills()->attach(
                        collect($skillIds)->random(rand(2, 10))->toArray()
                    );

                    $randomSeekerIds = collect($seekerIds)->random(rand(2, min(5, count($seekerIds))));
                    foreach ($randomSeekerIds as $seekerId) {
                        Application::factory()->create([
                            'job_id'    => $job->id,
                            'seeker_id' => $seekerId,
                        ]);
                    }

                    $randomSeekerIds = collect($seekerIds)->random(rand(2, min(5, count($seekerIds))));
                    foreach ($randomSeekerIds as $seekerId) {
                        Bookmark::factory()->create([
                            'job_id'    => $job->id,
                            'seeker_id' => $seekerId,
                        ]);
                    }
                })
                ->create(['company_id' => $company->id]);
        }

        $this->command->info('✅ Jobs (with details, skills, applicants, bookmarks) seeded.');
    }
}
