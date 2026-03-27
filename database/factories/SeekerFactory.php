<?php

namespace Database\Factories;

use App\Enums\ImageEntity;
use App\Helpers\ImageGeneratorHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeekerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'phone' => $this->faker->phoneNumber(),
            'bio' => $this->faker->realTextBetween(200, 500),
            'avatar' => ImageGeneratorHelper::generateFakeAvatar(entity: ImageEntity::SEEKER),
        ];
    }
}
