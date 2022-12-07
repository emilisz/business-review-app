<?php

namespace Tests\Feature;

use App\Models\Business;
use App\Models\Rating;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BusinessTest extends TestCase
{
    use withFaker, RefreshDatabase, DatabaseMigrations;



    public function testHomePageIsDisplayed(): void
    {
        $response = $this
            ->logIn()
            ->get(route('home'));

        $response->assertOk();
    }

    public function testUserCanViewAllBusinesses(): void
    {
        $business = Business::factory()->create();

        $this->get(route('home'))
            ->assertSee($business->title);
    }

    public function testUserCanViewOneBusiness(): void
    {
        $this->withoutExceptionHandling();

        $business = Business::factory()->create();

        $this->get(route('business.show', $business))
            ->assertSee($business->title);
    }

    public function testUserCanSeeOneBusinessRating(): void
    {
        $business = Business::factory()->create();
        Rating::factory()->create(['business_id'=> $business->id]);

        $this->get(route('business.show', $business))->assertSee(round($business->ratings_count));
    }

    public function testUserCanCreateBusiness(): void
    {
        $this->withoutExceptionHandling();
        $this->logIn();
        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];

        $this->post(route('business.store'), $attributes)->assertRedirect(route('home'));

        $this->assertDatabaseHas('businesses', $attributes);
        $this->get(route('home'))->assertSee($attributes['title']);
    }

    public function testBusinessRequiresTitle(): void
    {
        $attributes = Business::factory()->raw(['title' => '']);
        $this->logIn()->post(route('business.store'), $attributes)->assertSessionHasErrors('title');
    }

    public function testBusinessRequiresDescription(): void
    {
        $attributes = Business::factory()->raw(['description' => '']);
        $this->logIn()->post(route('business.store'), $attributes)->assertSessionHasErrors('description');
    }

    public function testOnlyAuthenticatedUserCanCreateBusiness(): void
    {
        $attributes = Business::factory()->raw();
        $this->post(route('business.store'), $attributes)->assertRedirect('/login');
    }

    public function testOnlyAuthenticatedUserCanSeeBusinessCreatePage(): void
    {
        $response = $this->get(route('business.create'));
        $response->assertRedirect(route('login'));

    }

    public function testGuestCannotSeeEditPage(): void
    {
        $business = Business::factory()->create();
        $this->get(route('business.edit', $business))->assertRedirect('/login');
    }

    public function testAuthUserCannotSeeAnotherUserBusinessEditPage(): void
    {
        $business = Business::factory()->create();
        $this->logIn()->get(route('business.edit', $business))->assertStatus(403);
    }

    public function testOwnerCanSeeTheirBusinessEditPage(): void
    {
        $business = Business::factory()->create();
        $this->logIn($business->user)->get(route('business.edit', $business))->assertSee($business->title);
    }

    public function testOwnerCanUpdateBusiness(): void
    {
        $business = Business::factory()->create();
        $this->logIn($business->user);
        $business->update(['title' => 'updated title', 'description' => 'updated description']);

        $this->assertDatabaseHas('businesses', [
            'title' => 'updated title',
            'description' => 'updated description'
        ]);
        $this->get(route('home'))->assertSee($business->title);

    }

    public function testOwnerCanDeleteBusiness(): void
    {
        $this->withoutExceptionHandling();

        $business = Business::factory()->create();
        $this->logIn($business->user);
        $this->delete(route('business.delete', $business));
        $this->assertModelMissing($business);

    }

    public function testUserCannotDeleteAnotherUserBusiness(): void
    {
        $business = Business::factory()->create();
        $this->logIn();

        $this->delete(route('business.delete', $business));
        $this->assertModelExists($business);
    }


}
