<?php

namespace Tests\Feature;

use App\Models\Business;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BusinessTest extends TestCase
{
    use withFaker, RefreshDatabase, DatabaseMigrations;

    public function test_home_page_is_displayed(): void
    {
        $response = $this
            ->logIn()
            ->get(route('home'));

        $response->assertOk();
    }

    public function test_user_can_view_all_businesses(): void
    {
//        $this->withoutExceptionHandling();

        $business = Business::factory()->create();

        $this->get(route('home'))
            ->assertSee($business->title);
    }

    public function test_user_can_view_one_business(): void
    {
        $this->withoutExceptionHandling();

        $business = Business::factory()->create();

        $this->get(route('business.show', $business))
            ->assertSee($business->title)
            ->assertSee($business->description);
    }

    public function test_user_can_create_a_business(): void
    {
        $this->withoutExceptionHandling();
        $this->logIn();
        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];

        $this->post(route('business.store'), $attributes)->assertRedirect(route('home'));

        $this->assertDatabaseHas('businesses', $attributes);
        $this->get('/')->assertSee($attributes['title']);
    }

    public function test_a_business_requires_a_title(): void
    {
//        $this->withoutExceptionHandling();
        $this->logIn();
        $attributes = Business::factory()->raw(['title' => '']);
        $this->post(route('business.store'), $attributes)->assertSessionHasErrors('title');
    }

    public function test_a_business_requires_a_description(): void
    {
        $this->logIn();
        $attributes = Business::factory()->raw(['description' => '']);
        $this->post(route('business.store'), $attributes)->assertSessionHasErrors('description');
    }

    public function test_only_authenticated_user_can_create_a_business(): void
    {
        $attributes = Business::factory()->raw();
        $this->post(route('business.store'), $attributes)->assertRedirect('/login');
    }

    public function test_only_authenticated_user_can_see_a_business_create_page(): void
    {
        $response = $this->get(route('business.create'));
        $response->assertRedirect(route('login'));

    }

    public function test_guest_cannot_see_edit_page(): void
    {
        $business = Business::factory()->create();
        $this->get(route('business.edit', $business))->assertRedirect('/login');
    }

    public function test_auth_user_cannot_see_another_user_business_edit_page(): void
    {
        $this->logIn();
        $business = Business::factory()->create();
        $this->get(route('business.edit', $business))->assertStatus(403);
    }

    public function test_owner_can_see_their_business_edit_page(): void
    {
        $business = Business::factory()->create();
        $this->logIn($business->user);

        $this->get(route('business.edit', $business))->assertSee($business['title']);
    }

    public function test_owner_can_update_their_business(): void
    {
        $business = Business::factory()->create();
        $this->logIn($business->user);
        $business->update(['title' => 'updated title', 'description' => 'updated description']);

        $this->assertDatabaseHas('businesses', [
            'title' => 'updated title',
            'description' => 'updated description'
        ]);
        $this->get('/')->assertSee($business->title);

    }

    public function test_owner_can_delete_their_business(): void
    {
        $business = Business::factory()->create();

        $this->logIn($business->user)->delete(route('business.delete', $business));
        $this->assertModelMissing($business);

    }

    public function test_user_cannot_delete_another_user_business(): void
    {
        $business = Business::factory()->create();
        $this->logIn();

        $this->delete(route('business.delete', $business));
        $this->assertModelExists($business);
    }


}
