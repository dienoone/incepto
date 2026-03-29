<?php

namespace App\Http\Controllers\Web\Employer;

use App\Services\EmployerService;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(
        protected EmployerService $service
    ) {}

    public function index(): View
    {
        $stats      = $this->service->getDashboardStats();
        $jobs       = $this->service->getJobs();
        $applicants = $this->service->getApplicants(['per_page' => 5]);

        return view('pages.employer.dashboard', compact('stats', 'jobs', 'applicants'));
    }
}
