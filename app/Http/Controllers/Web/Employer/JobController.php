<?php

namespace App\Http\Controllers\Web\Employer;

use App\Services\EmployerService;
use App\Enums\JobArrangement;
use App\Enums\JobType;
use App\Helpers\FakeDataHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Employer\StoreJobRequest;
use App\Http\Requests\Employer\UpdateJobRequest;
use App\Models\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class JobController extends Controller
{
    public function __construct(protected EmployerService $service) {}

    public function create(): View
    {
        return view('pages.employer.jobs.create', [
            'types'        => JobType::all(),
            'arrangements' => JobArrangement::all(),
            'levels'       => FakeDataHelper::JOB_LEVELS,
            'allSkills'    => Skill::orderBy('name')->pluck('name'),
        ]);
    }

    public function store(StoreJobRequest $request): RedirectResponse
    {
        $job = $this->service->createJob($request->validated());

        return redirect()->route('employer.dashboard')
            ->with('success', "Job \"{$job->title}\" published successfully!");
    }

    public function edit(int $id): View
    {
        $job = $this->service->getJob($id);

        return view('pages.employer.jobs.edit', [
            'job'          => $job,
            'types'        => JobType::all(),
            'arrangements' => JobArrangement::all(),
            'levels'       => FakeDataHelper::JOB_LEVELS,
            'allSkills'    => Skill::orderBy('name')->pluck('name'),
        ]);
    }

    public function update(UpdateJobRequest $request, int $id): RedirectResponse
    {
        $this->service->updateJob($id, $request->validated());
        return back()->with('success', 'Job updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->service->deleteJob($id);
        return redirect()->route('employer.dashboard')
            ->with('success', 'Job listing deleted.');
    }

    public function toggle(int $id): RedirectResponse
    {
        $job = $this->service->toggleJobStatus($id);
        $msg = $job->status->value === 'Open' ? 'Job is now active.' : 'Job paused successfully.';
        return back()->with('success', $msg);
    }
}
