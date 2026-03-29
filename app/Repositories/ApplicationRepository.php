<?php

namespace App\Repositories;

use App\Models\Application;
use App\Models\Job;
use App\Models\Seeker;

class ApplicationRepository
{
    public function create(array $data): Application
    {
        return Application::create($data);
    }

    public function alreadyApplied(Job $job, Seeker $seeker): bool
    {
        return Application::where('job_id', $job->id)
            ->where('seeker_id', $seeker->id)
            ->exists();
    }

    public function findBySeekerAndJob(Seeker $seeker, Job $job): ?Application
    {
        return Application::where('seeker_id', $seeker->id)
            ->where('job_id', $job->id)
            ->first();
    }
}
