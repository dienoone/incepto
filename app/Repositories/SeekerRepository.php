<?php

namespace App\Repositories;

use App\Models\Attachment;
use App\Models\Bookmark;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Seeker;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class SeekerRepository
{
    public function findByUser(User $user): ?Seeker
    {
        return $user->seeker()->with([
            'skills',
            'experiences',
            'educations',
            'attachments',
        ])->first();
    }

    public function updateProfile(Seeker $seeker, array $data): Seeker
    {
        // Handle avatar upload
        if (!empty($data['avatar'])) {
            // Delete old avatar
            if ($seeker->avatar) {
                Storage::disk('public')->delete($seeker->avatar);
            }
            $data['avatar'] = $data['avatar']->store('avatars/seekers', 'public');
        }

        $seeker->update(array_filter([
            'phone'  => $data['phone']  ?? null,
            'bio'    => $data['bio']    ?? null,
            'avatar' => $data['avatar'] ?? null,
        ], fn($v) => $v !== null));

        // Update user's name fields
        if (!empty($data['first_name']) || !empty($data['last_name'])) {
            $seeker->user->update(array_filter([
                'first_name' => $data['first_name'] ?? null,
                'last_name'  => $data['last_name']  ?? null,
            ], fn($v) => $v !== null));
        }

        return $seeker->fresh();
    }

    public function syncSkills(Seeker $seeker, array $skillIds): void
    {
        $seeker->skills()->sync($skillIds);
    }

    public function addExperience(Seeker $seeker, array $data): void
    {
        $logo = null;
        if (!empty($data['logo'])) {
            $logo = $data['logo']->store('logos/companies', 'public');
        }

        Experience::create([
            'seeker_id'   => $seeker->id,
            'company'     => $data['company'],
            'position'    => $data['position'],
            'description' => $data['description'] ?? null,
            'website'     => $data['website']     ?? null,
            'job_type'    => $data['job_type'],
            'start_date'  => $data['start_date'],
            'end_date'    => $data['end_date']    ?? null,
            'logo'        => $logo,
        ]);
    }

    public function deleteExperience(Seeker $seeker, int $id): void
    {
        Experience::where('id', $id)
            ->where('seeker_id', $seeker->id)
            ->delete();
    }

    public function addEducation(Seeker $seeker, array $data): void
    {
        Education::create([
            'seeker_id'      => $seeker->id,
            'school'         => $data['school'],
            'degree'         => $data['degree'],
            'field_of_study' => $data['field_of_study'],
            'address'        => $data['address'],
            'start_year'     => $data['start_year'],
            'end_year'       => $data['end_year'] ?? null,
            'description'    => $data['description'] ?? null,
        ]);
    }

    public function deleteEducation(Seeker $seeker, int $id): void
    {
        Education::where('id', $id)
            ->where('seeker_id', $seeker->id)
            ->delete();
    }

    public function addAttachment(Seeker $seeker, array $data): void
    {
        $path = $data['file']->store('attachments/seekers', 'public');

        Attachment::create([
            'seeker_id' => $seeker->id,
            'name'      => $data['name'],
            'type'      => $data['type'],
            'path'      => $path,
        ]);
    }

    public function deleteAttachment(Seeker $seeker, int $id): void
    {
        $attachment = Attachment::where('id', $id)
            ->where('seeker_id', $seeker->id)
            ->first();

        if ($attachment) {
            Storage::disk('public')->delete($attachment->path);
            $attachment->delete();
        }
    }

    public function getApplications(Seeker $seeker)
    {
        return $seeker->applications()
            ->with(['job.company'])
            ->latest()
            ->paginate(10);
    }

    public function addBookmark(Seeker $seeker, int $jobId): void
    {
        Bookmark::create([
            'job_id' => $jobId,
            'seeker_id' => $seeker->id
        ]);
    }

    public function getBookmarks(Seeker $seeker)
    {
        return $seeker->bookmarks()
            ->with(['job.company', 'job.skills'])
            ->latest()
            ->paginate(12);
    }
}
