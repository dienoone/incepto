<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

#[Fillable(['name'])]
class Skill extends Model
{
    /** @use HasFactory<\Database\Factories\SkillFactory> */
    use HasFactory;

    public function seekers(): MorphToMany
    {
        return $this->morphedByMany(Seeker::class, 'skillable');
    }

    public function jobs(): MorphToMany
    {
        return $this->morphedByMany(Job::class, 'skillable');
    }
}
