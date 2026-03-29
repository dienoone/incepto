<?php

namespace App\Services;

use App\Repositories\EmployerRepository;
use App\Enums\JobStatus;
use App\Models\Application;
use App\Models\Job;
use App\Models\Team;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class EmployerService
{
    public function __construct(protected EmployerRepository $repo) {}

    public function getDashboardStats(): array
    {
        return $this->repo->getDashboardStats();
    }

    public function getJobs(array $filters = []): LengthAwarePaginator
    {
        return $this->repo->getJobs($filters);
    }

    public function getJob(int $id): Job
    {
        return $this->repo->getJob($id);
    }

    public function createJob(array $data): Job
    {
        return $this->repo->createJob($data);
    }

    public function updateJob(int $id, array $data): Job
    {
        $job = $this->repo->getJob($id);
        return $this->repo->updateJob($job, $data);
    }

    public function deleteJob(int $id): void
    {
        $job = $this->repo->getJob($id);
        $this->repo->deleteJob($job);
    }

    public function toggleJobStatus(int $id): Job
    {
        $job    = $this->repo->getJob($id);
        $status = $job->status === JobStatus::OPEN ? JobStatus::CLOSED : JobStatus::OPEN;
        return $this->repo->updateJob($job, ['status' => $status]);
    }

    public function getApplicants(array $filters = []): LengthAwarePaginator
    {
        return $this->repo->getApplicants($filters);
    }

    public function getApplicant(int $id): Application
    {
        return $this->repo->getApplicant($id);
    }

    public function updateApplicantStatus(int $id, string $status): Application
    {
        $applicant  = $this->repo->getApplicant($id);
        $oldStatus  = $applicant->status->value;

        $updated = $this->repo->updateApplicantStatus($applicant, $status);

        return $updated;
    }

    public function getTeams(): Collection
    {
        return $this->repo->getTeams();
    }

    public function getMembers(): Collection
    {
        return $this->repo->getMembers();
    }

    public function createTeam(array $data): Team
    {
        return $this->repo->createTeam($data);
    }

    public function updateTeam(int $id, array $data): Team
    {
        $team = $this->repo->getTeams()->findOrFail($id);
        return $this->repo->updateTeam($team, $data);
    }

    public function deleteTeam(int $id): void
    {
        $team = Auth::user()->company->teams()->findOrFail($id);
        $this->repo->deleteTeam($team);
    }

    public function addTeamMember(int $teamId, array $data): void
    {
        $team = Auth::user()->company->teams()->findOrFail($teamId);
        $this->repo->addTeamMember($team, $data);
    }

    public function removeTeamMember(int $teamId, int $memberId): void
    {
        $team = Auth::user()->company->teams()->findOrFail($teamId);
        $this->repo->removeTeamMember($team, $memberId);
    }
}
