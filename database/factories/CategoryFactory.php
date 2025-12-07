<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->realTextBetween(8, 15, 2),
            'photo_url' => $this->faker->imageUrl(640, 480, 'animals', true,'cats'),
            'description'=>$this->faker->realTextBetween(160, 200, 2),
            'createdByAdmin_id'=>null,
            'updatedByAdmin_id'=>null,
        ];
    }
}
