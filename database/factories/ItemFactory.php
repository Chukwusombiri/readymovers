<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->realTextBetween(6,15,2),
            'photo_url'=>$this->faker->words(2, true),
            'description'=>$this->faker->paragraph(),
            'isCountable'=>true,
        ];
    }
}
