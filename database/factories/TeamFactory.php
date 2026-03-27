<?php

namespace Database\Factories;

use App\Enums\ImageEntity;
use App\Helpers\ImageGeneratorHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'        => $this->faker->words(rand(2, 3), true) . ' Team',
            'description' => $this->faker->realTextBetween(100, 250),
            'cover'      => ImageGeneratorHelper::generateRealImage(
                width: 800,
                height: 300,
                entity: ImageEntity::COMPANY
            ),
        ];
    }
}
