<?php

namespace App\Http\Controllers\Web\Seeker;

use App\Services\SeekerService;
use App\Enums\AttachmentType;
use App\Helpers\FakeDataHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Seeker\AddAttachmentRequest;
use App\Http\Requests\Seeker\AddEducationRequest;
use App\Http\Requests\Seeker\AddExperienceRequest;
use App\Http\Requests\Seeker\UpdateProfileRequest;
use App\Models\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function __construct(
        protected SeekerService $service
    ) {}

    public function show(): View
    {
        $seeker       = $this->service->getProfile();
        $completeness = $this->service->completeness();
        $allSkills    = Skill::orderBy('name')->get();
        $jobTypes     = FakeDataHelper::JOB_TYPES;
        $degrees      = FakeDataHelper::DEGREES;
        $fields       = FakeDataHelper::FIELDS_OF_STUDY;
        $attachTypes  = AttachmentType::all();

        return view('pages.seeker.profile', compact(
            'seeker',
            'completeness',
            'allSkills',
            'jobTypes',
            'degrees',
            'fields',
            'attachTypes'
        ));
    }

    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        $this->service->updateProfile($request->validated());
        return back()->with('success', 'Profile updated successfully.');
    }

    public function syncSkills(Request $request): RedirectResponse
    {
        $ids = $request->input('skills', []);
        $this->service->syncSkills($ids);
        return back()->with('success', 'Skills updated.');
    }

    public function addExperience(AddExperienceRequest $request): RedirectResponse
    {
        $this->service->addExperience($request->validated());
        return back()->with('success', 'Experience added.');
    }

    public function deleteExperience(int $id): RedirectResponse
    {
        $this->service->deleteExperience($id);
        return back()->with('success', 'Experience removed.');
    }

    public function addEducation(AddEducationRequest $request): RedirectResponse
    {
        $this->service->addEducation($request->validated());
        return back()->with('success', 'Education added.');
    }

    public function deleteEducation(int $id): RedirectResponse
    {
        $this->service->deleteEducation($id);
        return back()->with('success', 'Education removed.');
    }

    public function addAttachment(AddAttachmentRequest $request): RedirectResponse
    {
        $this->service->addAttachment($request->validated());
        return back()->with('success', 'Attachment uploaded.');
    }

    public function deleteAttachment(int $id): RedirectResponse
    {
        $this->service->deleteAttachment($id);
        return back()->with('success', 'Attachment removed.');
    }
}
