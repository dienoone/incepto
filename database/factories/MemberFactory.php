<?php

namespace Database\Factories;

use App\Enums\ImageEntity;
use App\Helpers\FakeDataHelper;
use App\Helpers\ImageGeneratorHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberFactory extends Factory
{
    public function definition(): array
    {
        $gender = $this->faker->randomElement(['male', 'female']);

        return [
            'name'     => $this->faker->firstName($gender) . ' ' . $this->faker->lastName(),
            'position' => $this->faker->randomElement(FakeDataHelper::JOB_LEVELS) . ' ' . $this->faker->jobTitle(),
            'bio'      => $this->faker->realTextBetween(80, 200),
            'avatar'   => ImageGeneratorHelper::generateFakeAvatar(entity: ImageEntity::COMPANY),
            'linkedin' => 'https://linkedin.com/in/' . $this->faker->slug(2),
        ];
    }
}
