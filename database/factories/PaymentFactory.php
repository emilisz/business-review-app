<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'valid_till' => now()->addMonth(),
            'amount' => fake()->randomFloat(2,2,3),
            'payment_method' => 'stripe',
            'user_id' => function(){
                return User::factory()->create()->id;
            }
        ];
    }
}
