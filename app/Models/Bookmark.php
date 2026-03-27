<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['job_id', 'seeker_id'])]
class Bookmark extends Model
{
    /** @use HasFactory<\Database\Factories\BookmarkFactory> */
    use HasFactory;

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class);
    }

    public function seeker(): BelongsTo
    {
        return $this->belongsTo(Seeker::class);
    }
}
