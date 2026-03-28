<?php

namespace App\Repositories;

use App\Enums\JobStatus;
use App\Models\Job;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class JobRepository
{
    public function paginate(array $filters, int $perPage = 15): LengthAwarePaginator
    {
        $query = Job::query()
            ->with(['company', 'skills']);

        // keyword search — title, description, company name, skill name
        if (!empty($filters['q'])) {
            $q = $filters['q'];
            $query->where(function ($sub) use ($q) {
                $sub->where('title', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%")
                    ->orWhereHas('company', fn($c) => $c->where('name', 'like', "%{$q}%"));
            });
        }


        // location
        if (!empty($filters['location'])) {
            $query->where('address', 'like', "%{$filters['location']}%");
        }

        // job type (Full-Time, Part-Time, etc.)
        if (!empty($filters['type'])) {
            $query->whereIn('type', (array) $filters['type']);
        }

        // work arrangement (Remote, Hybrid, On-Site)
        if (!empty($filters['arrangement'])) {
            $query->whereIn('arrangement', (array) $filters['arrangement']);
        }

        // experience level
        if (!empty($filters['level'])) {
            $query->whereIn('level', (array) $filters['level']);
        }

        // salary range
        if (!empty($filters['salary_min'])) {
            $query->where('salary_max', '>=', $filters['salary_min']);
        }
        if (!empty($filters['salary_max'])) {
            $query->where('salary_min', '<=', $filters['salary_max']);
        }

        // skills filter
        if (!empty($filters['skills'])) {
            $skills = is_array($filters['skills'])
                ? $filters['skills']
                : explode(',', $filters['skills']);

            // ✅ whereHas, not whereHasMorph
            $query->whereHas('skills', fn($s) => $s->whereIn('name', $skills));
        }

        // Sorting
        $sort = $filters['sort'] ?? 'newest';
        match ($sort) {
            'oldest'     => $query->oldest('published_at'),
            'salary_asc' => $query->orderBy('salary_min'),
            'salary_desc' => $query->orderByDesc('salary_max'),
            'popular'    => $query->orderByDesc('views'),
            default      => $query->latest('published_at'),
        };

        return $query->paginate($perPage)->withQueryString();
    }

    public function findBySlug(string $slug): ?Job
    {
        return Job::with([
            'company.companyImages',
            'company.reviews',
            'company.teams.members',
            'skills',
            'requirements',
            'responsibilities',
            'benefits',
        ])->where('slug', $slug)->first();
    }

    public function featured(int $limit = 6): Collection
    {
        return Job::with(['company', 'skills'])
            ->where('status', JobStatus::OPEN)
            ->orderByDesc('views')
            ->limit($limit)
            ->get();
    }

    public function relatedJobs(Job $job, int $limit = 4): Collection
    {
        return Job::with(['company'])
            ->where('status', JobStatus::OPEN)
            ->where('id', '!=', $job->id)
            ->where(function ($q) use ($job) {
                $q->where('type', $job->type)->orWhere('level', $job->level);
            })
            ->limit($limit)
            ->get();
    }
}
