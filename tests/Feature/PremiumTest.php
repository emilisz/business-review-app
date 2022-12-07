<?php

namespace Tests\Feature;

use App\Models\Business;
use App\Models\Payment;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PremiumTest extends TestCase
{
    use withFaker, RefreshDatabase, DatabaseMigrations;

    public function testOwnerSeePremiumContent(): void
    {
        $business = Business::factory()->create();

        $this->logIn($business->user)->get(route('business.show', $business))
            ->assertSee($business->phone);
    }

    public function testPremiumUserCanSeeContent(): void
    {
        $business = Business::factory()->create();
        $payment = Payment::factory()->create();

        $this->logIn($payment->user)->get(route('business.show', $business))
            ->assertSee($business->phone);
    }

    public function testUserDoNotSeePremiumContent(): void
    {
        $business = Business::factory()->create();

        $this->get(route('business.show', $business))
            ->assertDontSee($business->phone);
    }

    public function testUserPremiumExpired(): void
    {
        $business = Business::factory()->create();
        $payment = Payment::factory()->create(['valid_till' => now()->subDay()]);

        $this->logIn($payment->user)->get(route('business.show', $business))
            ->assertDontSee($business->address);
    }
}
