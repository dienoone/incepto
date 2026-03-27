<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(rand(3, 6)),
            'rate' => $this->faker->randomFloat(1, 0, 5),
            'pros' => $this->faker->realTextBetween(300, 500),
            'cons' => $this->faker->realTextBetween(300, 500),
            'details' => $this->faker->realTextBetween(300, 500),
            'anonymously' => $this->faker->boolean(),
            'likes' => $this->faker->numberBetween(100, 500)
        ];
    }
}
