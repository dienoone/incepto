<?php

namespace Database\Factories;

use App\Enums\AttachmentType;
use App\Helpers\FakeDataHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttachmentFactory extends Factory
{
    public function definition(): array
    {
        $attachment = $this->faker->randomElement(AttachmentType::all());

        return [
            'name' => $attachment,
            'path' => FakeDataHelper::ATTACHMENT_PATH,
            'type' => $attachment
        ];
    }
}
