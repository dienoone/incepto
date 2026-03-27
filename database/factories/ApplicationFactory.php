<?php

namespace Database\Factories;

use App\Enums\ApplicationStatus;
use App\Helpers\FakeDataHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicationFactory extends Factory
{
    public function definition(): array
    {
        // FIXME: expected_salary must be less than salary_max
        return [
            'attachment' => FakeDataHelper::ATTACHMENT_PATH,
            'cover_letter' => $this->faker->realTextBetween(200, 300),
            'expected_salary' => $this->faker->numberBetween(50, 150),
            'status' => $this->faker->randomElement(ApplicationStatus::all()),
            'message' => $this->faker->realTextBetween(300, 500)
        ];
    }
}
