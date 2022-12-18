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

    public function testUserSelectedMethodDoNotExists(): void
    {
        $attributes = [
            'payment_method' => 'dd'
        ];

        $this->logIn()->post(route('payment.store', $attributes))->assertStatus(500);
        $this->assertDatabaseMissing('payments', $attributes);
    }

}
