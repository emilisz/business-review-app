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
