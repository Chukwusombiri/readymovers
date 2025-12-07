<?php

namespace Database\Factories;

use App\Models\EmailSubscriber;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmailSubscriber>
 */
class EmailSubscriberFactory extends Factory
{
    protected $model = EmailSubscriber::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),            
        ];
    }
}
