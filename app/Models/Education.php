<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table(name: 'educations')]
#[Fillable(['school', 'degree', 'field_of_study', 'address', 'logo', 'description', 'start_year', 'end_year', 'seeker_id'])]
class Education extends Model
{
    /** @use HasFactory<\Database\Factories\EducationFactory> */
    use HasFactory;

    public function seeker(): BelongsTo
    {
        return $this->belongsTo(Seeker::class);
    }
}
