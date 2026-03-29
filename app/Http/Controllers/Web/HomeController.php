<?php

namespace App\Http\Controllers\Web;

use App\Services\CompanyService;
use App\Services\JobService;
use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Company;
use App\Models\Application;
use App\Models\Seeker;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(
        protected JobService     $jobService,
        protected CompanyService $companyService,
    ) {}

    public function index(): View
    {
        return view('pages.public.home', [
            'featuredJobs'      => $this->jobService->getFeatured(6),
            'featuredCompanies' => $this->companyService->getFeatured(6),
            'stats'             => [
                'jobs'      => Job::where('status', 'Open')->count(),
                'companies' => Company::count(),
                'seekers'   => Seeker::count(),
                'hired'     => Application::where('status', 'Accepted')->count(),
            ],
        ]);
    }
}
