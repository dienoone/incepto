<?php

namespace App\Models;

use App\Enums\DetailType;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

#[Fillable(['title', 'body', 'icon', 'type', 'detailable_id', 'detailable_type'])]
class Detail extends Model
{
    /** @use HasFactory<\Database\Factories\DetailFactory> */
    use HasFactory;

    protected $casts = [
        'type' => DetailType::class
    ];

    public function detailable(): MorphTo
    {
        return $this->morphTo();
    }
}
