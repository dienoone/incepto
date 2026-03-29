<?php

namespace App\Repositories;

use App\Enums\ApplicationStatus;
use App\Enums\JobStatus;
use App\Models\Application;
use App\Models\Company;
use App\Models\Job;
use App\Models\Member;
use App\Models\Skill;
use App\Models\Team;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EmployerRepository
{
    protected function company(): Company
    {
        return Auth::user()->company;
    }

    public function getCompany(): Company
    {
        return $this->company()->load(['jobs', 'members', 'teams']);
    }

    public function getDashboardStats(): array
    {
        $company = $this->company();

        return [
            'active_jobs'    => $company->jobs()->where('status', JobStatus::OPEN)->count(),
            'total_applicants' => Application::whereHas('job', fn($q) => $q->where('company_id', $company->id))->count(),
            'new_today'      => Application::whereHas('job', fn($q) => $q->where('company_id', $company->id))
                ->whereDate('created_at', today())->count(),
            'interviews'     => Application::whereHas('job', fn($q) => $q->where('company_id', $company->id))
                ->where('status', ApplicationStatus::INTERVIEW)->count(),
        ];
    }

    public function getJobs(array $filters = []): LengthAwarePaginator
    {
        $query = $this->company()->jobs()
            ->withCount('applications')
            ->latest();

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }
        if (!empty($filters['q'])) {
            $query->where('title', 'like', '%' . $filters['q'] . '%');
        }

        return $query->paginate(15)->withQueryString();
    }

    public function getJob(int $id): Job
    {
        return $this->company()->jobs()
            ->with(['skills', 'requirements', 'responsibilities', 'benefits'])
            ->findOrFail($id);
    }

    public function createJob(array $data): Job
    {
        $job = $this->company()->jobs()->create([
            'title'        => $data['title'],
            'slug'         => Str::slug($data['title']) . '-' . Str::random(6),
            'description'  => $data['description'],
            'address'      => $data['address'],
            'type'         => $data['type'],
            'level'        => $data['level'],
            'arrangement'  => $data['arrangement'],
            'salary_min'   => $data['salary_min'],
            'salary_max'   => $data['salary_max'],
            'status'       => $data['status'] ?? JobStatus::OPEN,
            'published_at' => now(),
            'expires_at'   => $data['expires_at'],
        ]);

        // Skills
        if (!empty($data['skills'])) {
            $skillIds = Skill::whereIn('name', $data['skills'])->pluck('id');
            $job->skills()->sync($skillIds);
        }

        // Requirements
        if (!empty($data['requirements'])) {
            foreach ($data['requirements'] as $req) {
                if (trim($req)) {
                    $job->requirements()->create([
                        'title' => $req,
                        'type'  => \App\Enums\DetailType::REQUIREMENT,
                    ]);
                }
            }
        }

        // Responsibilities
        if (!empty($data['responsibilities'])) {
            foreach ($data['responsibilities'] as $resp) {
                if (trim($resp)) {
                    $job->responsibilities()->create([
                        'title' => $resp,
                        'type'  => \App\Enums\DetailType::RESPONSIBILITY,
                    ]);
                }
            }
        }

        return $job;
    }

    public function updateJob(Job $job, array $data): Job
    {
        $job->update(array_filter([
            'title'       => $data['title']       ?? null,
            'description' => $data['description'] ?? null,
            'address'     => $data['address']     ?? null,
            'type'        => $data['type']        ?? null,
            'level'       => $data['level']       ?? null,
            'arrangement' => $data['arrangement'] ?? null,
            'salary_min'  => $data['salary_min']  ?? null,
            'salary_max'  => $data['salary_max']  ?? null,
            'expires_at'  => $data['expires_at']  ?? null,
        ], fn($v) => $v !== null));

        if (isset($data['skills'])) {
            $skillIds = Skill::whereIn('name', $data['skills'])->pluck('id');
            $job->skills()->sync($skillIds);
        }

        return $job->fresh();
    }

    public function deleteJob(Job $job): void
    {
        $job->delete();
    }

    public function getApplicants(array $filters = []): LengthAwarePaginator
    {
        $query = Application::query()
            ->with(['job.company', 'seeker.user', 'seeker.skills'])
            ->whereHas('job', fn($q) => $q->where('company_id', $this->company()->id));

        if (!empty($filters['job_id'])) {
            $query->where('job_id', $filters['job_id']);
        }
        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }
        if (!empty($filters['q'])) {
            $query->whereHas('seeker.user', fn($q) => $q->where('first_name', 'like', '%' . $filters['q'] . '%')
                ->orWhere('last_name', 'like', '%' . $filters['q'] . '%'));
        }

        return $query->latest()->paginate(15)->withQueryString();
    }

    public function getApplicant(int $id): Application
    {
        return Application::with([
            'job.company',
            'seeker.user',
            'seeker.skills',
            'seeker.experiences',
            'seeker.educations',
            'seeker.attachments',
        ])
            ->whereHas('job', fn($q) => $q->where('company_id', $this->company()->id))
            ->findOrFail($id);
    }

    public function updateApplicantStatus(Application $applicant, string $status): Application
    {
        $applicant->update(['status' => $status]);
        return $applicant->fresh();
    }

    public function getTeams(): Collection
    {
        return $this->company()->teams()->with('members')->get();
    }


    public function getMembers(): Collection
    {
        return $this->company()->members;
    }

    public function createTeam(array $data): Team
    {
        $banner = null;
        if (!empty($data['banner'])) {
            $banner = $data['banner']->store('covers/companies', 'public');
        }

        return $this->company()->teams()->create([
            'name'        => $data['name'],
            'description' => $data['description'],
            'banner'      => $banner,
        ]);
    }

    public function updateTeam(Team $team, array $data): Team
    {
        if (!empty($data['banner'])) {
            if ($team->banner) Storage::disk('public')->delete($team->banner);
            $data['banner'] = $data['banner']->store('covers/companies', 'public');
        }

        $team->update(array_filter([
            'name'        => $data['name']        ?? null,
            'description' => $data['description'] ?? null,
            'banner'      => $data['banner']      ?? null,
        ], fn($v) => $v !== null));

        return $team->fresh();
    }

    public function deleteTeam(Team $team): void
    {
        $team->delete();
    }

    public function addTeamMember(Team $team, array $data): void
    {
        $avatar = null;
        if (!empty($data['avatar'])) {
            $avatar = $data['avatar']->store('avatars/companies', 'public');
        }

        Member::create([
            'team_id'  => $team->id,
            'name'     => $data['name'],
            'position' => $data['position'],
            'bio'      => $data['bio']      ?? '',
            'linkedin' => $data['linkedin'] ?? null,
            'avatar'   => $avatar,
        ]);
    }

    public function removeTeamMember(Team $team, int $memberId): void
    {
        Member::where('id', $memberId)
            ->where('team_id', $team->id)
            ->delete();
    }
}
