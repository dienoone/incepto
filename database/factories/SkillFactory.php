<?php

namespace Database\Factories;

use App\Helpers\FakeDataHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

class SkillFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement(FakeDataHelper::SKILLS)
        ];
    }
}
