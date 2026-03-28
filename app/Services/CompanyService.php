<?php

namespace App\Services;

use App\Models\Company;
use App\Models\Follow;
use App\Repositories\CompanyRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class CompanyService
{
    public function __construct(
        protected CompanyRepository $repo
    ) {}

    public function search(array $filters): LengthAwarePaginator
    {
        return $this->repo->paginate($filters);
    }

    public function getBySlug(string $slug): Company
    {
        $company = $this->repo->findBySlug($slug);

        if (!$company) {
            throw new ModelNotFoundException("Company [{$slug}] not found.");
        }

        return $company;
    }

    public function getFeatured(int $limit = 6): Collection
    {
        return $this->repo->featured($limit);
    }

    public function getAllIndustries(): array
    {
        return $this->repo->allIndustries();
    }

    public function isFollowing(Company $company): bool
    {
        if (!Auth::check()) return false;

        $seeker = Auth::user()->seeker;
        if (!$seeker) return false;

        return Follow::where('company_id', $company->id)
            ->where('seeker_id', $seeker->id)
            ->exists();
    }

    public function toggleFollow(Company $company): bool
    {
        $seeker = Auth::user()->seeker;

        $existing = Follow::where('company_id', $company->id)
            ->where('seeker_id', $seeker->id)
            ->first();

        if ($existing) {
            $existing->delete();
            return false;
        }

        Follow::create([
            'company_id' => $company->id,
            'seeker_id'  => $seeker->id,
        ]);

        return true;
    }
}
