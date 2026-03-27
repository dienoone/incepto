<?php

namespace Database\Factories;

use App\Enums\ImageEntity;
use App\Helpers\FakeDataHelper;
use App\Helpers\ImageGeneratorHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

class EducationFactory extends Factory
{
    public function definition(): array
    {
        $start_year = $this->faker->year();
        $end_year = $this->faker->year($start_year);
        $school = $this->faker->city() . ' ' . $this->faker->randomElement(FakeDataHelper::SCHOOL_TYPES);

        return [
            'school' => $school,
            'degree' => $this->faker->randomElement(FakeDataHelper::DEGREES),
            'field_of_study' => $this->faker->randomElement(FakeDataHelper::FIELDS_OF_STUDY),
            'address' => $this->faker->city() . ', ' . $this->faker->state(),
            'logo' => ImageGeneratorHelper::generateFakeAvatar(name: $school, entity: ImageEntity::COMPANY),
            'description' => $this->faker->realTextBetween(300, 500),
            'start_year' => $start_year,
            'end_year' => $end_year
        ];
    }
}
