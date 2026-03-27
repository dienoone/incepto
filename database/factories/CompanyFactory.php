<?php

namespace Database\Factories;

use App\Enums\ImageEntity;
use App\Helpers\FakeDataHelper;
use App\Helpers\ImageGeneratorHelper;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CompanyFactory extends Factory
{
    public function definition(): array
    {
        $name = $this->faker->company();

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'logo' => ImageGeneratorHelper::generateFakeAvatar(name: $name, entity: ImageEntity::COMPANY),
            'cover' => ImageGeneratorHelper::generateRealImage(entity: ImageEntity::COMPANY),
            'bio' => $this->faker->realTextBetween(300, 500),
            'website' => $this->faker->url(),
            'industry' => $this->faker->randomElement(FakeDataHelper::INDUSTRIES),
            'address' => $this->faker->city() . ' ' . $this->faker->state(),
            'founded_year' => $this->faker->year(),
            'funding' => $this->faker->randomElement(FakeDataHelper::FUNDING),
            'revenue_min' => $this->faker->numberBetween(100, 150),
            'revenue_max' => $this->faker->numberBetween(150, 200),
            'size' => $this->faker->randomElement(['10-100', '100-200', '200-300', '300-400', '400-500', '500+']),
        ];
    }
}
