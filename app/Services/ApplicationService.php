<?php

namespace App\Services;

use App\Repositories\ApplicationRepository;
use App\Enums\ApplicationStatus;
use App\Models\Application;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ApplicationService
{
    public function __construct(
        protected ApplicationRepository $repo
    ) {}

    public function apply(Job $job, array $data): Application
    {
        $seeker = Auth::user()->seeker;

        // Guard: must have a seeker profile
        if (!$seeker) {
            throw ValidationException::withMessages([
                'general' => 'Complete your seeker profile before applying.',
            ]);
        }

        // Guard: no duplicate applications
        if ($this->repo->alreadyApplied($job, $seeker)) {
            throw ValidationException::withMessages([
                'general' => 'You have already applied for this position.',
            ]);
        }

        // Handle attachment upload
        $attachmentPath = null;
        if (!empty($data['attachment'])) {
            $attachmentPath = $data['attachment']->store('attachments/applicants', 'public');
        }

        $applicant = $this->repo->create([
            'job_id'          => $job->id,
            'seeker_id'       => $seeker->id,
            'attachment'      => $attachmentPath,
            'cover_letter'    => $data['cover_letter'] ?? null,
            'expected_salary' => $data['expected_salary'],
            'message'         => $data['message'] ?? null,
            'status'          => ApplicationStatus::PENDING,
        ]);

        return $applicant;
    }

    public function hasApplied(Job $job): bool
    {
        if (!Auth::check()) return false;

        $seeker = Auth::user()->seeker;
        if (!$seeker) return false;

        return $this->repo->alreadyApplied($job, $seeker);
    }
}
