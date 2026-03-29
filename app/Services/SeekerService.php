<?php

namespace App\Services;

use App\Repositories\SeekerRepository;
use App\Models\Bookmark;
use App\Models\Job;
use App\Models\Seeker;
use App\Models\Skill;
use Illuminate\Support\Facades\Auth;

class SeekerService
{
    public function __construct(protected SeekerRepository $repo) {}

    protected function seeker(): Seeker
    {
        return Auth::user()->seeker;
    }

    public function getProfile(): Seeker
    {
        return $this->repo->findByUser(Auth::user());
    }

    public function updateProfile(array $data): Seeker
    {
        return $this->repo->updateProfile($this->seeker(), $data);
    }

    public function syncSkills(array $skillIds): void
    {
        // Validate skill IDs belong to real skills
        $validIds = Skill::whereIn('id', $skillIds)->pluck('id')->toArray();
        $this->repo->syncSkills($this->seeker(), $validIds);
    }

    public function addExperience(array $data): void
    {
        $this->repo->addExperience($this->seeker(), $data);
    }

    public function deleteExperience(int $id): void
    {
        $this->repo->deleteExperience($this->seeker(), $id);
    }

    public function addEducation(array $data): void
    {
        $this->repo->addEducation($this->seeker(), $data);
    }

    public function deleteEducation(int $id): void
    {
        $this->repo->deleteEducation($this->seeker(), $id);
    }

    public function addAttachment(array $data): void
    {
        $this->repo->addAttachment($this->seeker(), $data);
    }

    public function deleteAttachment(int $id): void
    {
        $this->repo->deleteAttachment($this->seeker(), $id);
    }

    public function getApplications()
    {
        return $this->repo->getApplications($this->seeker());
    }

    public function getBookmarks()
    {
        return $this->repo->getBookmarks($this->seeker());
    }


    public function addBookmark(int $jobId)
    {
        return $this->repo->addBookmark($this->seeker(), $jobId);
    }

    public function removeBookmark(int $jobId): void
    {
        Bookmark::where('job_id', $jobId)
            ->where('seeker_id', $this->seeker()->id)
            ->delete();
    }

    // Profile completeness score (0-100)
    public function completeness(): int
    {
        $seeker = $this->getProfile();
        $score  = 0;

        if ($seeker->avatar)                        $score += 15;
        if ($seeker->bio)                           $score += 15;
        if ($seeker->phone)                         $score += 10;
        if ($seeker->skills->isNotEmpty())          $score += 20;
        if ($seeker->experiences->isNotEmpty())     $score += 20;
        if ($seeker->educations->isNotEmpty())      $score += 10;
        if ($seeker->attachments->isNotEmpty())     $score += 10;

        return $score;
    }
}
