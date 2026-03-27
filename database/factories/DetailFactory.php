<?php

namespace Database\Factories;

use App\Enums\DetailType;
use App\Helpers\FakeDataHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetailFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->catchPhrase(),
        ];
    }

    public function requirement(): static
    {
        return $this->state(fn(array $attributes) => [
            'type' => DetailType::REQUIREMENT,
        ]);
    }

    public function responsibility(): static
    {
        return $this->state(fn(array $attributes) => [
            'type' => DetailType::RESPONSIBILITY,
        ]);
    }

    public function benefit(): static
    {
        return $this->state(fn(array $attributes) => [
            'type' => DetailType::BENEFIT,
            'body' => $this->faker->paragraph(),
            'icon' => $this->faker->randomElement(FakeDataHelper::HEROICONS),
        ]);
    }


    public function mission(): static
    {
        return $this->state(fn(array $attributes) => [
            'type' => DetailType::MISSION,
            'body' => $this->faker->paragraph(),
            'icon' => $this->faker->randomElement(FakeDataHelper::HEROICONS),
        ]);
    }
}
