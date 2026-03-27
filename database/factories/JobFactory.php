<?php

namespace Database\Factories;

use App\Enums\JobArrangement;
use App\Enums\JobStatus;
use App\Enums\JobType;
use App\Helpers\FakeDataHelper;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class JobFactory extends Factory
{
    public function definition(): array
    {
        $title = $this->faker->jobTitle();
        $status = $this->faker->randomElement(JobStatus::all());

        return [
            'title' => $title,
            'slug' => Str::slug($title) . '-' . $this->faker->unique()->numberBetween(1000, 99999),
            'description' => $this->faker->realTextBetween(300, 500),
            'address' => $this->faker->city() . ', ' . $this->faker->state(),
            'type' => $this->faker->randomElement(JobType::all()),
            'level' => $this->faker->randomElement(FakeDataHelper::JOB_LEVELS),
            'arrangement' => $this->faker->randomElement(JobArrangement::all()),
            'salary_min' => $this->faker->numberBetween(2000, 3000),
            'salary_max' => $this->faker->numberBetween(3500, 5000),
            'views' => $this->faker->numberBetween(1000, 5000),
            'status' => $status,
            'published_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'expires_at' => function (array $attributes) {
                return $attributes['status'] === JobStatus::OPEN
                    ? $this->faker->dateTimeBetween('now', '+6 months')
                    : $this->faker->dateTimeBetween('-3 months', '-1 day');
            },
        ];
    }
}
