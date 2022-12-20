<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Business>
 */
class BusinessFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'image_url' => fake()->imageUrl(),
            'user_id' => function(){
                return User::factory()->create()->id;
            },
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address,
            'employees' => fake()->randomDigit()
        ];
    }
}
