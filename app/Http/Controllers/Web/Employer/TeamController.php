<?php

namespace App\Http\Controllers\Web\Employer;

use App\Services\EmployerService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Employer\StoreTeamMemberRequest;
use App\Http\Requests\Employer\StoreTeamRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TeamController extends Controller
{
    public function __construct(protected EmployerService $service) {}

    public function index(): View
    {
        $teams = $this->service->getTeams();
        $allMembers = $this->service->getMembers();
        return view('pages.employer.teams.index', compact('teams', 'allMembers'));
    }

    public function store(StoreTeamRequest $request): RedirectResponse
    {
        $this->service->createTeam($request->validated());
        return back()->with('success', 'Team created successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->service->deleteTeam($id);
        return back()->with('success', 'Team deleted.');
    }

    public function addMember(StoreTeamMemberRequest $request, int $teamId): RedirectResponse
    {
        $this->service->addTeamMember($teamId, $request->validated());
        return back()->with('success', 'Member added successfully.');
    }

    public function removeMember(int $teamId, int $memberId): RedirectResponse
    {
        $this->service->removeTeamMember($teamId, $memberId);
        return back()->with('success', 'Member removed.');
    }
}
