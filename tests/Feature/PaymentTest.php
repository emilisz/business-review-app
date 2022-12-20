<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PaymentTest extends TestCase
{
    use withFaker, RefreshDatabase, DatabaseMigrations;

    public function testUserCanMakePayment(): void
    {
        $attributes = [
            'payment_method' => 'stripe'
        ];

        $this->logIn()->post(route('payment.store', $attributes));
        $this->assertDatabaseHas('payments', $attributes);
    }

    /**
     * @dataProvider paymentMethods
     */
    public function testUserSelectedPaymentMethodDoNotExists($name): void
    {
        $this->logIn()->post(route('payment.store', ['payment_method' => $name]))->assertStatus(500);
        $this->assertDatabaseMissing('payments', ['payment_method' => $name]);
    }


    public function paymentMethods(): \Generator
    {
        yield "capitalized letter" => [
            'name' => 'Stripe'
        ];
        yield "non existent name" => [
            'name' => 'paypal5'
        ];
    }

}
