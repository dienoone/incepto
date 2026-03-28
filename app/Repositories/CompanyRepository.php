<?php

namespace App\Repositories;

use App\Enums\JobStatus;
use App\Models\Company;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class CompanyRepository
{
    public function paginate(array $filters, int $perPage = 12): LengthAwarePaginator
    {
        $query = Company::query()
            ->withCount([
                'jobs'      => fn($q) => $q->where('status', JobStatus::OPEN),
                'follows',
                'reviews',
            ])
            ->withAvg('reviews', 'rate');

        // Keyword search
        if (!empty($filters['q'])) {
            $term = $filters['q'];
            $query->where(function ($sub) use ($term) {
                $sub->where('name', 'like', "%{$term}%")
                    ->orWhere('bio', 'like', "%{$term}%")
                    ->orWhere('industry', 'like', "%{$term}%");
            });
        }

        // Industry filter
        if (!empty($filters['industry'])) {
            $query->where('industry', $filters['industry']);
        }

        // Company size filter
        if (!empty($filters['size'])) {
            $query->where('size', $filters['size']);
        }

        // Hiring filter — only show companies with open jobs
        if (!empty($filters['hiring'])) {
            $query->whereHas('jobs', fn($q) => $q->where('status', JobStatus::OPEN));
        }

        // Sorting
        match ($filters['sort'] ?? 'jobs') {
            'newest'     => $query->latest(),
            'oldest'     => $query->oldest(),
            'followers'  => $query->orderByDesc('followers_count'),
            'rating'     => $query->orderByDesc('reviews_avg_rate'),
            default      => $query->orderByDesc('jobs_count'),
        };

        return $query->paginate($perPage)->withQueryString();
    }

    public function findBySlug(string $slug): ?Company
    {
        return Company::with([
            'jobs'          => fn($q) => $q->where('status', JobStatus::OPEN)->with('skills')->latest()->limit(10),
            'members',
            'reviews.seeker.user',
            'companyImages',
            'missions',
            'benefits',
            'teams.members',
        ])
            ->withCount(['jobs' => fn($q) => $q->where('status', JobStatus::OPEN), 'follows', 'reviews'])
            ->withAvg('reviews', 'rate')
            ->where('slug', $slug)
            ->first();
    }

    public function featured(int $limit = 6): Collection
    {
        return Company::withCount([
            'jobs' => fn($q) => $q->where('status', JobStatus::OPEN),
        ])
            ->having('jobs_count', '>', 0)
            ->orderByDesc('jobs_count')
            ->limit($limit)
            ->get();
    }

    public function allIndustries(): array
    {
        return Company::distinct()
            ->orderBy('industry')
            ->pluck('industry')
            ->filter()
            ->values()
            ->toArray();
    }
}
