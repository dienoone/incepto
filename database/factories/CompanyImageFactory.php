<?php

namespace Database\Factories;

use App\Enums\ImageEntity;
use App\Helpers\ImageGeneratorHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyImageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'path' => ImageGeneratorHelper::generateRealImage(entity: ImageEntity::COMPANY)
        ];
    }
}
