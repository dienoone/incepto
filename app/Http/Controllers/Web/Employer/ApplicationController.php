<?php

namespace App\Http\Controllers\Web\Employer;

use App\Services\EmployerService;
use App\Enums\ApplicationStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ApplicationController extends Controller
{
    public function __construct(protected EmployerService $service) {}

    public function index(Request $request): View
    {
        $filters    = array_filter($request->only(['q', 'job_id', 'status']));
        $applicants = $this->service->getApplicants($filters);
        $jobs       = Auth::user()->company->jobs()->pluck('title', 'id');
        $statuses   = ApplicationStatus::all();

        return view(
            'pages.employer.applicants.index',
            compact('applicants', 'jobs', 'statuses', 'filters')
        );
    }

    public function show(int $id): View
    {
        $applicant = $this->service->getApplicant($id);
        $statuses  = ApplicationStatus::all();

        return view('pages.employer.applicants.show', compact('applicant', 'statuses'));
    }

    public function updateStatus(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'status' => ['required', 'in:' . implode(',', ApplicationStatus::all())],
        ]);

        $this->service->updateApplicantStatus($id, $request->status);

        return back()->with('success', 'Applicant status updated.');
    }
}
