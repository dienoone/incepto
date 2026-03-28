<?php

namespace App\Services;

use App\Repositories\JobRepository;
use App\Models\Job;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class JobService
{
    public function __construct(protected JobRepository $repo) {}

    public function search(array $filters): LengthAwarePaginator
    {
        return $this->repo->paginate($filters);
    }

    public function getBySlug(string $slug): Job
    {
        $job = $this->repo->findBySlug($slug);

        if (!$job) {
            throw new ModelNotFoundException("Job [{$slug}] not found.");
        }

        $job->increment('views');

        return $job;
    }

    public function getFeatured(int $limit = 6): Collection
    {
        return $this->repo->featured($limit);
    }

    public function getRelated(Job $job, int $limit = 4): Collection
    {
        return $this->repo->relatedJobs($job, $limit);
    }
}
