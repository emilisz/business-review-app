<?php

namespace Database\Factories;

use App\Models\Business;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rating>
 */
class RatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'comment' => fake()->sentence(),
            'rating' => fake()->numberBetween(1,5),
            'user_id' => function(){
                return User::factory()->create()->id;
            },
            'business_id' => function(){
                return Business::factory()->create()->id;
            }
        ];
    }
}
