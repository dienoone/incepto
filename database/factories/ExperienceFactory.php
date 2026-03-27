<?php

namespace Database\Factories;

use App\Enums\ImageEntity;
use App\Helpers\FakeDataHelper;
use App\Helpers\ImageGeneratorHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExperienceFactory extends Factory
{
    public function definition(): array
    {
        $company_name = $this->faker->company();

        return [
            'company' => $company_name,
            'logo' => ImageGeneratorHelper::generateFakeAvatar(name: $company_name, entity: ImageEntity::COMPANY),
            'position' => $this->faker->randomElement(FakeDataHelper::JOB_LEVELS) . ' ' . fake()->jobTitle(),
            'description' => $this->faker->realTextBetween(300, 500),
            'website' => $this->faker->url(),
            'job_type' => $this->faker->randomElement(FakeDataHelper::JOB_TYPES),
            'start_date' => $this->faker->dateTimeBetween('-10 years', '-1 years'),
            'end_date' => $this->faker->dateTimeBetween('-1 years', 'now'),
        ];
    }
}
