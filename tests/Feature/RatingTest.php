<?php

namespace Tests\Feature;

use App\Models\Business;
use App\Models\Rating;
use App\Models\User;
use Generator;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RatingTest extends TestCase
{
    use withFaker, RefreshDatabase ,DatabaseMigrations;

    public function test_auth_user_can_post_ratings(): void
    {
        $this->logIn();

        $business = Business::factory()->create(['user_id' => auth()->id()]);
        $rating = [
            'rating' => $this->faker->numberBetween(1,5),
            'comment' => $this->faker->sentence,
            'business_id' => $business->id,
            'user_id' => auth()->id()
        ];

        $this->post(route('rating.store',$business), $rating);
        $this->get(route('business.show', $business))->assertSee($rating['comment']);
    }

    public function test_rating_belongs_to_business(): void
    {
        $rating = Rating::factory()->create();

        $this->assertInstanceOf(Business::class, $rating->business);
    }

    public function test_rating_belongs_to_user(): void
    {
        $rating = Rating::factory()->create();

        $this->assertInstanceOf(User::class, $rating->user);
    }

    public function test_rating_requires_a_rating(): void
    {
        $this->logIn();

        $business = Business::factory()->create(['user_id' => auth()->id()]);

        $rating = Rating::factory()->raw(['rating' => null]);
        $this->post(route('rating.store',$business), $rating)->assertSessionHasErrors('rating');
    }

    public function test_rating_do_not_require_a_comment(): void
    {
        $this->logIn();

        $business = Business::factory()->create(['user_id' => auth()->id()]);

        $rating = Rating::factory()->raw(['comment' => null]);
        $this->post(route('rating.store',$business), $rating);
        $this->get(route('business.show', $business))->assertSee($rating['rating']);
    }

    public function test_rating_owner_can_delete_rating(): void
    {
        $rating = Rating::factory()->create();
        $this->logIn($rating->user);

        $this->delete(route('rating.delete',[$rating->business, $rating]));
        $this->assertModelMissing($rating);
    }

    public function test_guest_cannot_delete_rating(): void
    {
        $rating = Rating::factory()->create();
        $this->delete(route('rating.delete',[$rating->business, $rating]));
        $this->assertModelExists($rating);
    }


    /**
     * @dataProvider numbersProvider
     */
    public function test_rating_between_numbers_required($number): void
    {
        $this->logIn();

        $business = Business::factory()->create(['user_id' => auth()->id()]);

        $ratingHigher = Rating::factory()->raw(['rating' => $number]);
        $this->post(route('rating.store',$business), $ratingHigher)->assertSessionHasErrors('rating');
    }

    public function numbersProvider(): Generator
    {
        yield "higher number" => [
            'number' => 6
        ];
        yield "decimal number" => [
            'number' => 2.5
        ];
        yield "null number" => [
            'number' => 0
        ];
        yield "string" => [
            'number' => 'hello'
        ];
    }


}
