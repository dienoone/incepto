<?php

namespace App\Http\Controllers\Web\Seeker;

use App\Services\SeekerService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SavedJobController extends Controller
{
    public function __construct(
        protected SeekerService $service
    ) {}

    public function index(): View
    {
        $bookmarks    = $this->service->getBookmarks();
        $completeness = $this->service->completeness();

        return view('pages.seeker.saved', compact('bookmarks', 'completeness'));
    }

    public function store(int $jobId): RedirectResponse
    {
        $this->service->addBookmark($jobId);
        return back()->with('success', 'Job bookmarked successfully.');
    }

    public function destroy(int $jobId): RedirectResponse
    {
        $this->service->removeBookmark($jobId);
        return back()->with('success', 'Job removed from saved jobs.');
    }
}
