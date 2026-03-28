<?php

namespace App\Http\Controllers\Web;

use App\Services\JobService;
use App\Enums\JobArrangement;
use App\Enums\JobType;
use App\Helpers\FakeDataHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Job\JobFilterRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class JobController extends Controller
{
    public function __construct(protected JobService $service) {}

    public function index(JobFilterRequest $request): View
    {
        $jobs = $this->service->search($request->filters());

        return view('pages.public.jobs.index', [
            'jobs'         => $jobs,
            'filters'      => $request->filters(),
            'types'        => JobType::all(),
            'arrangements' => JobArrangement::all(),
            'levels'       => FakeDataHelper::JOB_LEVELS,
            'skills'       => FakeDataHelper::SKILLS,
            'totalCount'   => $jobs->total(),
        ]);
    }

    public function show(string $slug): View|RedirectResponse
    {
        try {
            $job     = $this->service->getBySlug($slug);
            $related = $this->service->getRelated($job);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('jobs.index')
                ->with('error', 'Job listing not found or has expired.');
        }

        return view('pages.public.jobs.show', compact('job', 'related'));
    }
}
