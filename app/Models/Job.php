<?php

namespace App\Models;

use App\Enums\DetailType;
use App\Enums\JobArrangement;
use App\Enums\JobStatus;
use App\Enums\JobType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

#[Table('job_listings')]
#[Fillable(['title', 'description', 'address', 'type', 'level', 'arrangement', 'salary_min', 'salary_max', 'views', 'status', 'published_at', 'expires_at', 'company_id'])]
class Job extends Model
{
    /** @use HasFactory<\Database\Factories\JobFactory> */
    use HasFactory;

    protected $casts = [
        'type' => JobType::class,
        'arrangement' => JobArrangement::class,
        'status' => JobStatus::class,
        'published_at' => 'datetime',
        'expires_at' => 'datetime'
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function requirements(): MorphMany
    {
        return $this->morphMany(Detail::class, 'detailable')
            ->where('type', DetailType::REQUIREMENT);
    }

    public function responsibilities(): MorphMany
    {
        return $this->morphMany(Detail::class, 'detailable')
            ->where('type', DetailType::RESPONSIBILITY);
    }

    public function benefits(): MorphMany
    {
        return $this->morphMany(Detail::class, 'detailable')
            ->where('type', DetailType::BENEFIT);
    }

    public function skills(): MorphToMany
    {
        return $this->morphToMany(Skill::class, 'skillable')
            ->withTimestamps();
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    public function bookmarks(): HasMany
    {
        return $this->hasMany(Bookmark::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', JobStatus::OPEN)
            ->where('expires_at', '>', now());
    }
}
