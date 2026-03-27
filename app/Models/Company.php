<?php

namespace App\Models;

use App\Enums\DetailType;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;

#[Fillable(['name', 'slug', 'logo', 'cover', 'bio', 'website', 'industry', 'address', 'founded_year', 'funding', 'revenue_min', 'revenue_max', 'size', 'user_id'])]
class Company extends Model
{
    /** @use HasFactory<\Database\Factories\CompanyFactory> */
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function missions(): MorphMany
    {
        return $this->morphMany(Detail::class, 'detailable')
            ->where('type', DetailType::MISSION);
    }

    public function benefits(): MorphMany
    {
        return $this->morphMany(Detail::class, 'detailable')
            ->where('type', DetailType::BENEFIT);
    }

    public function companyImages(): HasMany
    {
        return $this->hasMany(CompanyImage::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function teams(): HasMany
    {
        return $this->hasMany(Team::class);
    }


    public function members(): HasManyThrough
    {
        return $this->hasManyThrough(Member::class, Team::class);
    }

    public function follows(): HasMany
    {
        return $this->hasMany(Follow::class);
    }

    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class);
    }
}
