<?php

namespace App\Http\Controllers\Web\Seeker;

use App\Services\SeekerService;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(protected SeekerService $service) {}

    public function applications(): View
    {
        $applications = $this->service->getApplications();
        $completeness = $this->service->completeness();

        return view('pages.seeker.applications', compact('applications', 'completeness'));
    }
}
